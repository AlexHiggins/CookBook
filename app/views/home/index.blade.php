@extends('layout.default')

@section('content')

<div class="container">
	@include('partials.title', ['title' => $title])
  @include('recipe.partials.grid')
</div>

@stop