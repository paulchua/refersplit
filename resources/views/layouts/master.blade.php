<!DOCTYPE html>
<html>
<head>
    <title>
        {{-- Yield the title if it exists, otherwise default to 'ReferSplit' --}}
        @yield('title','ReferSplit')
    </title>

    <meta charset='utf-8'>

    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' 
rel='stylesheet'>

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/lumen/bootstrap.min.css' 
rel='stylesheet'>

    <link href='/css/foobooks.css' rel='stylesheet'>

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

</head>
<body>
<center>
    @if(Session::get('message') != null)
        <div class='flash_message'>{{ Session::get('message') }}</div>
    @endif

    <header>
        <a href='/'>
        <img
        src='http://www.alexachua.com/refersplit.jpg'
        alt='ReferSplit Logo'
        class='logo'>
        </a>
    </header>

	<B>The one stop for listing your referal posts!</B>
	
	<table border = "1" width = "350">
	<tr>
	<td>
    <nav>
        <ul>
            <li><a href='/listings'>View all listings</a></li>
            @if(Auth::check())
                <li><a href='/listing/create'>Add a new listing</a></li>
                <li><a href='/logout'>Logout</a></li>
            @else
                <li><a href='/login'>Login</a></li>
                <li><a href='/register'>Register</a></li>
            @endif
        </ul>
    </nav>
	</td>
	</tr>
	</table>

    <section>
        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>
<hr>
    <footer>
        &copy; {{ date('Y') }} &nbsp;&nbsp;
        <a href='https://github.com/paulchua/refersplit' target='_blank'><i class='fa fa-github'></i> View 
on Github</a> &nbsp;&nbsp;
      
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')
</center>
</body>
</html>
