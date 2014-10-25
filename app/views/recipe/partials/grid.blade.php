@foreach($recipes->chunk(3) as $recipeChunk)
	<div class="row recipe-row">
		@foreach($recipeChunk as $recipe)
			<article class="col-lg-4 col-md-4">
				<div class="white-box">
					{{ link_to_route('recipe.show', $recipe->present()->recipeTitle(), ['slug' => $recipe->slug], ['class' => 'title']) }}
					<p>by <b>{{ link_to_route('user.show', $recipe->user->username, ['slug' => $recipe->user->username], ['class' => 'theme-colour']) }}</b></p>
					<p>Submitted {{ $recipe->present()->createdAt() }}</p>
					<div class="clearfix">
						@foreach($recipe->tags as $tag)
							{{ link_to_route('tag.show', $tag->slug, ['slug' => $tag->slug], ['class' => 'tag']) }}
						@endforeach
					</div>
				</div>
			</article>
		@endforeach
	</div>
@endforeach

<div class="row">
  <div class=" col-md-12 text-center">
    {{ $recipes->links() }}
  </div>
</div>