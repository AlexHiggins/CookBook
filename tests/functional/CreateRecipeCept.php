<?php 
$I = new FunctionalTester($scenario);

$I->am('CookBook Member');
$I->wantTo('Create a recipe');

$I->signIn();
$tagOne = $I->haveTag(['name' => 'tag1']);
$tagTwo = $I->haveTag(['name' => 'tag2']);

$I->click('Create New');
$I->seeCurrentUrlEquals('/recipe/create');
$I->fillField('title', 'querty one');
$I->fillField('description', 'description');
$I->fillField('code', 'code');
$I->selectOption('.chosen-select', ['tag2', 'tag1']);
$I->click('Create', 'input[type="submit"]');

$I->seeCurrentUrlEquals('/recipe/querty-one');
$I->seeRecord('recipes', ['title' => 'querty one']);
$I->seeRecord('recipe_tag', ['tag_id' => $tagOne->id]);
$I->seeRecord('recipe_tag', ['tag_id' => $tagTwo->id]); // tidy this test up