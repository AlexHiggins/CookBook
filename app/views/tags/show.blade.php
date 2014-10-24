@extends('layout.default')

@section('content')

<div class="container">
	@section('title', "Recipes Matching Tag \"{$tag->name}\"")
  @include('recipe.partials.grid')
</div>

@stop