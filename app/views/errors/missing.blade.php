@extends('layout.default')

@section('content')

<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h2 class="text-center">Doh! This page doesn't exist </h2>
			<p class="text-center lead">Don't worry, you can go back to our {{ link_to_route('home', 'homepage') }} and forget that this ever happened.</p>
		</div>
	</div>

</div>

@stop
