@extends('layout.default')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">

      @include('partials.errors')

      <div class="white-box">
        {{ Form::open(['route' => 'recipe.store']) }}
					@include('recipe.partials.form')
        {{ Form::close() }}
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>

@stop
