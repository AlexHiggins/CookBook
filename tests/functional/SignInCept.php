<?php
$I = new FunctionalTester($scenario);

$I->am('a Cookbook member');
$I->wantTo('Sign in to my account');

$I->amOnPage('/');
$I->signIn();
$I->assertTrue(Auth::check()); // Improve this...