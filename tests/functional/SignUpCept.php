<?php 
$I = new FunctionalTester($scenario);
$I->am('A guest');
$I->wantTo('I want to sign up for a CookBook account');
$I->amOnPage('/');
$I->click('Register');
$I->fillField('username', 'John');
$I->fillField('email', 'john.doe@example.com');
$I->fillField('password', 'password');
$I->fillField('password_confirmation', 'password');
$I->click('Create Account');

$I->see('Welcome to Laravel CookBook!');
$I->see('Logout');
$I->assertTrue(Auth::check());
$I->seeRecord('users', ['username' => 'john', 'email' => 'john.doe@example.com']);
