@extends('layout.default')

@section('content')

<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h2 class="text-center">Doh! This page doesn't exist </h2>
			<p class="text-center lead">Don't worry, you can go back to our {{ link_to_route('home', 'homepage') }} and forget that this happened.</p>
		</div>
	</div>

	<div class="row text-center">
		<div class="col-md-12">
			{{ HTML::image('images/not-found.png', '404 image', ['class' => 'responsive not-found-image']) }}
		</div>
	</div>
	
</div>

@stop
