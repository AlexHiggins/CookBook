@extends('layout.default')

@section('content')

<div class="container">

  <div class="row user-stats">
    <div class="col-md-12">
      <div class="user-information white-box">
        <div class="information-container">

          <div class="user-image">
            @include('users.gravatar')
          </div>

          <div class="recipe-title-container">
            <h2 class="title username theme-colour">{{ $user->username }}</h2>
            <p>Joined {{ $user->present()->registerDate() }}</p>
          </div>

        </div>
      </div>
    </div>
  </div>

  @if(!$recipes->isEmpty())
    @include('partials.title', ['title' => "Recipes"])
    @include('recipe.partials.grid')
  @endif

</div>
@stop