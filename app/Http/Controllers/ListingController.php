<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingController extends Controller {
    /**
    * Responds to requests to GET /listings
    */
    public function getIndex() {
    
	$listings = \App\Listing::all();
    return view('listings.index')->with('listings', $listings);
    }
    /**
     * Responds to requests to GET /books/show/{id}
     */
    public function getShow($id = null) {
        $book = \App\Book::find($id);
        if(is_null($book)) {
            \Session::flash('message','Book not found');
            return redirect('/books');
        }
        # Fetch similar books from the Goole Books API
        $googleBooks = new \App\Libraries\GoogleBooks();
        $author_name = $book->author->first_name.' '.$book->author->last_name;
        $otherBooksByThisAuthor = $googleBooks->getOtherBooksByAuthor($author_name);
        return view('books.show',[
            'book' => $book,
            'otherBooksByThisAuthor' => $otherBooksByThisAuthor
        ]);
    }
    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {

        return view('listings.create');
    }
    /**
     * Responds to requests to POST /book/create
     */
    public function postCreate(Request $request) {
        $messages = [
            'not_in' => 'You have to choose an author.',
        ];
        $this->validate($request,[
            'title' => 'required|min:1',
            'description' => 'required|min:10'
        ],$messages);
      
        $data = $request->only('title','description');
        $data['user_id'] = \Auth::id();
        # One way to add the data
        #$book = new \App\Book($data);
        #$book->save();
        # An alternative way to add the data
        $listing = \App\Listing::create($data);
        # Save Tags
        #$tags = ($request->tags) ?: [];
        #$listing->tags()->sync($tags);
        #$listing->save();
        \Session::flash('message','Your listing was added');
        return redirect('/listings');
    }
    /**
	* Responds to requests to GET /book/edit/{id?}
	*/
    public function getEdit($id) {
        $book = \App\Book::with('tags')->find($id);
        if(is_null($book)) {
            \Session::flash('message','Book not found');
            return redirect('/books');
        }
        if($book->user_id != \Auth::id()) {
            \Session::flash('message','You do not have access to edit that book.');
            return redirect('/books');
        }
        $authors_for_dropdown = \App\Author::authorsForDropdown();
        $tags_for_checkboxes = \App\Tag::getTagsForCheckboxes();
        $tags_for_this_book = $book->getTagsForThisBook();
        return view('books.edit')
            ->with('book',$book)
            ->with('authors_for_dropdown',$authors_for_dropdown)
            ->with('tags_for_checkboxes',$tags_for_checkboxes)
            ->with('tags_for_this_book',$tags_for_this_book);
    }
    /**
	* Responds to requests to POST /book/edit/{id?}
	*/
    public function postEdit(Request $request) {
        $messages = [
            'not_in' => 'You have to choose an author.',
        ];
        $this->validate($request,[
            'title' => 'required|min:3',
            'published' => 'required|min:4',
            'cover' => 'required|url',
            'purchase_link' => 'required|url',
            'author_id' => 'not_in:0'
        ],$messages);
        $book = \App\Book::find($request->id);
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->cover = $request->cover;
        $book->published = $request->published;
        $book->purchase_link = $request->purchase_link;
        # If there were tags selected...
        if($request->tags) {
            $tags = $request->tags;
        }
        # If there were no tags selected (i.e. no tags in the request)
        # default to an empty array of tags
        else {
            $tags = [];
        }
        $book->tags()->sync($tags);
        $book->save();
        \Session::flash('message','Your changes were saved.');
        return redirect('/book/edit/'.$request->id);
    }
    /**
	* Responds to requests to GET /book/confirm-delete/{id?}
	*/
    public function getConfirmDelete($id = null) {
        $book = \App\Book::find($id);
        return view('books.delete')->with('book', $book);
    }
    /**
	* Responds to requests to GET /book/delete/{id?}
	*/
    public function getDelete($id = null) {
        # Get the book to be deleted
        $book = \App\Book::find($id);
        if(is_null($book)) {
            \Session::flash('message','Book not found.');
            return redirect('/books');
        }
        # First remove any tags associated with this book
        if($book->tags()) {
            $book->tags()->detach();
        }
        # Then delete the book
        $book->delete();
        # Done
        \Session::flash('message',$book->title.' was deleted.');
        return redirect('/books');
    }
    /**
	* Responds to requests to GET /book/search/
	* Shows an ajax text input to search for books
	*/
    public function getSearch() {
        return view('books.search');
    }
    /**
    * Responds to requests to POST /book/search/
    * This method is used in response to an ajax request from GET /book/search
    * See /public/js/search.js
    */
    public function postSearch(Request $request) {
        # Do the search with the provided search term ($request->search)
        $books = \App\Book::where('title','LIKE','%'.$request->search.'%')->get();
        # Return the view with the books
        return view('books.search-ajax')->with(
            ['books' => $books]
        );
    }
} # eoc