<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('See tags and how many recipes have that tag');

$recipe = $I->haveRecipe();
$recipeTwo = $I->haveRecipe();

$tagOne = $I->haveTag(['name' => 'very generic tag']);
$tagTwo = $I->haveTag(['name' => 'another generic tag']);

$I->assignTagToRecipe($recipe, $tagOne);
$I->assignTagToRecipe($recipeTwo, $tagOne);
$I->assignTagToRecipe($recipeTwo, $tagTwo);

$I->amOnPage('/');
$I->click('Tags');

$I->see(2, ".{$tagOne->id}-count");
$I->see('very generic tag', '.tag-container');

$I->see(1, ".{$tagTwo->id}-count");
$I->see('another generic tag', '.tag-container'); // clean this test up
