@extends('layout.default')

@section('search')
	@include('partials.search')
@stop

@section('content')

<div class="container">
	@section('title', $title)
	@include('recipe.partials.grid')
</div>

@stop