<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Sign out of my account');
$I->signIn();
$I->assertTrue(Auth::check());
$I->signOut();
$I->assertFalse(Auth::check());
$I->see('Login', '#navigation');