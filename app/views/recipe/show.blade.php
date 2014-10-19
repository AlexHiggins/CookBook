@extends('layout.default')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-9 recipe-container">
      <div class="white-box">
        @include('recipe.partials.show')
      </div>
    </div>

    <div class="col-md-3 stats-container">
      <div class="white-box">
        @include('recipe.partials.stats')
      </div>
    </div>
  </div>

  <div class="row replies-container">
    <div class="col-md-9">
      @include('disqus.messages' , ['identifier' => $recipe->id])
    </div>
  </div>

</div>
@stop