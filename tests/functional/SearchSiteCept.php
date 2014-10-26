<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Search site for recipe');

$recipe = $I->haveRecipe(['title' => 'foobar']);

$I->amOnPage('/');
$I->fillField('q', 'foobar');
$I->click('search');
$I->seeCurrentUrlEquals('/search?q=foobar');
$I->see('Search Results For "foobar"');
$I->see($recipe->title, '.white-box');

$I->fillField('q', '');
$I->click('search');
$I->seeCurrentUrlEquals('/search?q=');
$I->see('Please provide a search term');