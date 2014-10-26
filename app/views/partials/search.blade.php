{{ Form::open(['url'=>'search','method'=>'GET']);}}
<div class="input-group">
	<input type="text" name="q" class="search-box form-control" placeholder="Search..." value="{{{ isset($query) ? $query : ''}}}">
		<div class="input-group-btn">
			<button class="search btn btn-default" id="search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		</div>
</div>
{{ Form::close()}}