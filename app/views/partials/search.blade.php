{{ Form::open(['url'=>'search','method'=>'GET']);}}
	<input type="text" name="q" class="search-box form-control" placeholder="Search..." value="{{{ isset($query) ? $query : ''}}}">
{{ Form::close()}}