@extends('layouts.master')

@section('title')
    Edit listing {{ $listing->title }}
@stop

@section('content')

    <h1>Edit listing {{ $listing->title }}</h1>

    <a href='/listing/confirm-delete/{{$listing->id}}'><i class='fa fa-trash'></i> Delete</a><br>

    <form method='POST' action='/listing/edit'>

        <input type='hidden' name='id' value='{{$listing->id}}'>

        {{ csrf_field() }}

        <div class='form-group'>
           <label>Title:</label>
            <input
                type='text'
                id='title'
                name='title'
                value='{{ $listing->title }}'
            >
           <div class='error'>{{ $errors->first('title') }}</div>
        </div>

		<div class='form-group'>
           <label>Desc:</label>
            <input
                type='text'
                id='description'
                name='description'
                value='{{ $listing->description }}'
            >
           <div class='error'>{{ $errors->first('description') }}</div>
        </div>

				<div class='form-group'>
           <label>Desc:</label>
            <input
                type='text'
                id='email'
                name='email'
                value='{{ $listing->email }}'
            >
           <div class='error'>{{ $errors->first('email') }}</div>
        </div>

        <div class='form-instructions'>
            All fields are required
        </div>

        <button type="submit" class="btn btn-primary">Save changes</button>

        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form>


@stop