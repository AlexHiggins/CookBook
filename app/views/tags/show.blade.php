@extends('layout.default')

@section('content')

<div class="container">
  @include('partials.title', ['title' => "Recipes Matching Tag \"{$tag->name}\""])
  @include('recipe.partials.grid')
</div>

@stop