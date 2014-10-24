@extends('layout.default')

@section('content')

<div class="container">
	@section('title', $title)
  @include('recipe.partials.grid')
</div>

@stop