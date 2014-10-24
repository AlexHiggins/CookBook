<?php
$I = new FunctionalTester($scenario);

$I->am('a Cookbook member');
$I->wantTo('Sign in to my account');

$I->amOnPage('/');
$I->signIn();
$I->see('Welcome back!');
$I->assertTrue(Auth::check());
