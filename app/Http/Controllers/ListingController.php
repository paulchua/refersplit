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
     * Responds to requests to GET /listing/create
     */
    public function getCreate() {

        return view('listings.create');
    }
    /**
     * Responds to requests to POST /listing/create
     */
    public function postCreate(Request $request) {

        $this->validate($request,[
            'title' => 'required|min:1',
            'description' => 'required|min:10',
			'email' => 'required|min:3'
        ]);
      
        $data = $request->only('title','description','email');
        $data['user_id'] = \Auth::id();
      
        $listing = \App\Listing::create($data);
     
        \Session::flash('message','Your listing was added');
        return redirect('/listings');
    }
    /**
	* Responds to requests to GET /listing/edit/{id?}
	*/
    public function getEdit($id) {
       $listing = \App\Listing::where('id','LIKE',$id)->first();
        return view('listings.edit')->with('listing', $listing);;
    }
    /**
	* Responds to requests to POST /listings/edit/{id?}
	*/
    public function postEdit(Request $request) {
        $messages = [
            'not_in' => 'You have to choose an author.',
        ];
        $this->validate($request,[
            'title' => 'required|min:3',
            'description' => 'required|min:4',
			'email' => 'required|min:3'
        ],$messages);
        $listing = \App\Listing::find($request->id);
        $listing->title = $request->title;
        $listing->description = $request->description;
		$listing->email = $request->email;
      
        $listing->save();
        \Session::flash('message','Your changes were saved.');
        return redirect('/listing/edit/'.$request->id);
    }
    /**
	* Responds to requests to GET /listing/confirm-delete/{id?}
	*/
    public function getConfirmDelete($id = null) {
        $listing = \App\Listing::find($id);
        return view('listings.delete')->with('listing', $listing);
    }
    /**
	* Responds to requests to GET /listing/delete/{id?}
	*/
    public function getDelete($id = null) {
        # Get the listing to be deleted
        $listing = \App\Listing::find($id);
        if(is_null($listing)) {
            \Session::flash('message','Listing not found.');
            return redirect('/listings');
        }
       
        # Then delete the listing
        $listing->delete();
        # Done
        \Session::flash('message',$listing->title.' was deleted.');
        return redirect('/listings');
    }

} # eoc