@extends('layouts.master')

@section('title')
    Delete Listing
@stop

@section('content')
    <h1>Delete Listing</h1>
    <p>Are you sure you want to delete <em>{{$listing->title}}</em>?</p>
    <p><strong><a href='/listing/delete/{{$listing->id}}'>Yes, delete it.</a></strong></p>
    <p><a href='/listings'>No, I changed my mind.</a></p>
@stop