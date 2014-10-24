<div class="information-container">

  <div class="user-image">
    @include('users.gravatar', ['user' => $recipe->user])
  </div>

  <div class="recipe-title-container">
    <h2 class="title theme-colour">{{{ $recipe->present()->recipeTitle() }}} </h2>
    <p>
    	Submitted by <span class="theme-colour">{{ link_to_route('user.show', $recipe->user->username, ['slug' => $recipe->user->username], ['class' => 'theme-colour']) }}</span>
    	{{ $recipe->present()->createdAt() }}
    </p>
  </div>

</div>

<p class="recipe-description">{{{ $recipe->description }}}</p>

@include('markdown.preview', ['code' => $recipe->present()->code()])
