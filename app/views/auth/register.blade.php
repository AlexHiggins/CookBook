@extends('layout.default')

@section('content')

<div class="container">

	@section('title')
		@include('partials.title', ['title' => 'Register'])
	@stop

  <div class="row">
    <div class="col-md-offset-3 col-md-6">

      @include('partials.errors')

      <div class="white-box">
        {{ Form::open() }}
          <div class="form-group">
            {{ Form::label('username','Username:') }}
            {{ Form::text('username', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('email','Email:') }}
            {{ Form::text('email', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('password_confirmation', 'Password Confirmation:') }}
            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::submit('Create Account', ['class' => 'btn btn-primary']) }}
          </div>
        {{ Form::close() }}
      </div>

    </div>
  </div>
</div>

@stop