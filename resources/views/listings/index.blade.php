@extends('layouts.master')

@section('head')
    <link href='/css/book.css' rel='stylesheet'>
@stop

@section('title')
    Listings
@stop

@section('content')
<align = left>
    <h1>All the listings</h1>
	<hr>

  @foreach($listings as $listing)
    <h2>{{ $listing->title }}</h2>
	<h2>{{ $listing->description }}</h2>
	<h2>{{ $listing->email }}</h2>
	<a href='/listing/edit/{{ $listing->id }}'><i class='fa fa-pencil'></i> Edit</a><br>
	<hr>
@endforeach

@stop