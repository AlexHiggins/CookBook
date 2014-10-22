@extends('layout.default')

@section('content')

<div class="container">

	@section('title')
		@include('partials.title', ['title' => 'Recent Recipes'])
	@stop

  @include('recipe.partials.grid')
</div>

@stop