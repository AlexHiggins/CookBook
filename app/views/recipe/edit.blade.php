@extends('layout.default')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">

      @include('partials.errors')

      <div class="white-box">
        {{ Form::model($recipe, ['method' => 'PATCH', 'route' => ['recipe.update', $recipe->slug]]) }}
					@include('recipe.partials.form', ['buttonText' => 'Update'])
        {{ Form::close() }}
      </div>

    </div>
    <div class="col-md-2"></div>
  </div>
</div>

@stop

@section('js')
{{ HTML::script('js/vendor/chosen.js') }}
{{ HTML::script('js/vendor/epiceditor.js') }}

{{ HTML::script('js/chosen.js') }}
{{ HTML::script('js/epiceditor.js') }}
@stop