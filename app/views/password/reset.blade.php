@extends('layout.default')

@section('content')

<div class="container">

	@section('title')
		@include('partials.title', ['title' => 'Reset your password'])
	@stop

	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">

			@include('partials.errors')

			<div class="white-box">
				{{ Form::open() }}

					{{ Form::hidden('token', $token) }}

					<div class="form-group">
						{{ Form::label('email','Email Address:') }}
						{{ Form::email('email', null, ['class' => 'form-control']) }}
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
						{{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
					</div>

				{{ Form::close() }}
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
@stop