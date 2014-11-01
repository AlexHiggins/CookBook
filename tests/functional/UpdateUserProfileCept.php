<?php 
$I = new FunctionalTester($scenario);
$I->am('A user');
$I->wantTo('I want to update the credentials of my account');

$I->signIn();
$I->click('Settings');
$I->seeCurrentUrlEquals('/user/alex/edit');
$I->seeRecord('users', ['email' => 'alex@example.com']);
$I->fillField('email', 'alex.higgins@example.com');
$I->click('Update Account');
$I->seeCurrentUrlEquals('/user/alex/edit');
$I->see('Your profile has been updated!');
$I->seeRecord('users', ['email' => 'alex.higgins@example.com']);