<div class="form-group">
	{{ Form::label('title','Title:') }}
	{{ Form::text('title', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('description','Description:') }}
	{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) }}
</div>

<div class="form-group">
	<label>Code:</label>
	<div class="epiceditor" id="epiceditor"></div>
	{{ Form::textarea('code', null, ['class' => 'hide', 'id' => 'code']) }}
</div>

<div class="form-group">
	{{ Form::label('tags','Tags:') }}
	{{ Form::select('tags[]', $tags, isset($selectedTags) ?: [], array('multiple', 'id'=>'tags','class' => 'chosen-select form-control')) }}
</div>

<div class="form-group">
	{{ Form::submit(isset($buttonText) ? $buttonText : 'Create', ['class' => 'btn btn-primary']) }}
</div>