@extends('layout.default')

@section('content')

<div class="container">
  @include('partials.title', ['title' => 'Recent Recipes'])
  @include('recipe.partials.grid')
</div>

@stop