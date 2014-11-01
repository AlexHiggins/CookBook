@extends('layout.default')

@section('content')

<div class="container">

	@section('title', 'Update Profile')

  <div class="row">
    <div class="col-md-offset-3 col-md-6">

      @include('partials.errors')

      <div class="white-box">

        {{ Form::model($user, ['method' => 'PATCH', 'route' => ['user.update', $user->username]]) }}

          <div class="form-group">
            {{ Form::label('email','Email:') }}
            {{ Form::text('email', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::submit('Update Account', ['class' => 'btn btn-primary']) }}
          </div>

        {{ Form::close() }}

      </div>
    </div>
  </div>
</div>

@stop