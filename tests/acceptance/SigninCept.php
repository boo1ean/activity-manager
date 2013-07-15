<?php
$I = new WebGuy($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/');
$I->see('Hello, davert');