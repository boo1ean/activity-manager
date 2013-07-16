<?php
$I = new WebGuy($scenario);
$I->wantTo('log in with incorrect data');
$I->amOnPage('/site/login');
$I->see('Login');
$I->fillField('LoginForm[email]','test');
$I->fillField('LoginForm[password]','test');
$I->click('#login');
$I->see('Incorrect username or password.');