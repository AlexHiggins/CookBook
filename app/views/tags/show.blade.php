@extends('layout.default')

@section('content')

<div class="container">

	@section('title')
		@include('partials.title', ['title' => "Recipes Matching Tag \"{$tag->name}\""])
	@stop

  @include('recipe.partials.grid')
</div>

@stop