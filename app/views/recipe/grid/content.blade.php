<article class="col-lg-4 col-md-4">
	<div class="white-box">
		<h2><a href="{{ route('recipe.show', ['slug' => $recipe->slug]) }}" class="title">{{{ $recipe->present()->recipeTitle() }}}</a></h2>
		<p>by <a href="{{ route('profile.show', ['slug' => $recipe->user->username]) }}" class="theme-colour">{{{ $recipe->user->username }}}</a></p>
		<p>Submitted {{ $recipe->present()->createdAt() }}</p>
		<div class="clearfix">
			@foreach($recipe->tags as $tag)
				{{ link_to_route('tag.show', $tag->slug, ['slug' => $tag->slug], ['class' => 'tag']) }}
			@endforeach
		</div>
	</div>
</article>