@foreach($recipes->chunk(3) as $recipeChunk)
	<div class="row recipe-row">
		@foreach($recipeChunk as $recipe)
			@include('recipe.grid.content')
		@endforeach
	</div>
@endforeach

<div class="row">
  <div class=" col-md-12 text-center">
    {{ $recipes->appends(Request::except('page'))->links() }}
  </div>
</div>