@extends('layout.default')

@section('content')

<div class="container">

	@section('title', 'Need to reset your password?')

	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">

			@include('partials.errors')

			<div class="white-box">
				{{ Form::open() }}

					<div class="form-group">
						{{ Form::label('email','Email Address:') }}
						{{ Form::email('email', null, ['class' => 'form-control']) }}
					</div>

					<div class="form-group">
						{{ Form::submit('Reset Password', ['class' => 'btn btn-primary']) }}
					</div>

				{{ Form::close() }}
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
@stop