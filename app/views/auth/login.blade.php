@extends('layout.default')

@section('content')
<div class="container">

	@include('partials.title', ['title' => 'Login'])

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
            {{ Form::label('password','Password:') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
          </div>

					<div class="form-group">
						<label>{{ Form::checkbox('remember') }} <span class="remember-me">Remember me</span></label>
					</div>

          <div class="form-group">
             {{ Form::submit('Login', ['class' => 'login-btn btn btn-primary']) }}
             {{ link_to('/password/remind', 'Reset Your Password', ['class' => 'password-rest-btn btn btn-primary']) }}
          </div>

        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

@stop