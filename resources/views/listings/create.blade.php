@extends('layouts.master')

@section('title')
    Add a new Listing
@stop

@section('content')

    <h1>Add a new Listing</h1>

    <form method='POST' action='/listing/create'>

        {{ csrf_field() }}

        <div class='form-group'>
           <label>Title:</label>
            <input
                type='text'
                id='title'
                name='title'
                value='{{ old('title') }}'
            >
           <div class='error'>{{ $errors->first('title') }}</div>
        </div>

          <div class='form-group'>
           <label>Description:</label>
            <input
                type='text'
                id='description'
                name='description'
                value='{{ old('description') }}'
            >
           <div class='error'>{{ $errors->first('description') }}</div>
        </div>
		
		<div class='form-group'>
           <label>Contact Email:</label>
            <input
                type='text'
                id='email'
                name='email'
                value='{{ old('email') }}'
            >
           <div class='error'>{{ $errors->first('email') }}</div>
        </div>

        <button type="submit" class="btn btn-primary">Add Listing</button>

        {{--
        <ul class=''>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        --}}

        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form>

@stop	
	