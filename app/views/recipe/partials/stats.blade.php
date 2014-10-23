@if (isset($currentUser->id) && $recipe->user_id == $currentUser->id)
	<b>Recipe</b>
	<ul class="stats-list">
		<li>{{ link_to_route('recipe.edit', 'edit', ['slug' => $recipe->slug], ['class' => 'theme-colour']) }}</li>
	</ul>
@endif

<b>Stats</b>
<ul class="stats-list">
  <li><span class="glyphicon glyphicon-eye-open"></span> {{ $recipe->views }}</li>
</ul>

@if( ! $recipe->tags->isEmpty())
  <b>Tags</b>
  <ul>
    @foreach($recipe->tags as $tag)
      <li>{{ link_to_route('tag.show', $tag->name, ['slug' => $tag->slug], ['class' => 'theme-colour']) }}</li>
    @endforeach
  </ul>
@endif