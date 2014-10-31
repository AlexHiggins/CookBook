<?php 
$I = new FunctionalTester($scenario);

$recipe = $I->haveRecipe(['title' => 'ah, ah, ah the count!']);

$I->wantTo('I can view a users profile and their recipes');
$I->amOnPage('/');
$I->see($recipe->user->username, '.white-box');
$I->click($recipe->user->username, '.white-box');
$I->amOnPage("/profile/{$recipe->user->username}");

$I->see('Recipes', '.page-title');
$I->see($recipe->user->username, '.username');
$I->see('ah, ah, ah the count!', '.recipe-row');
