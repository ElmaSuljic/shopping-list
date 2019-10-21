<?php 

class LoginTestsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

	/* See if login form exists */
    public function findLoginForm(AcceptanceTester $I){
		$I->amOnPage('/');
		$I->click('Login');  
		$I->seeElement('#loginForm');
    }
	
	/* See if login form exists */
    public function logWithRegistratedUser(AcceptanceTester $I){
		$I->amOnPage('/');
		$I->click('Login');  
		$I->seeElement('#loginForm');

		$I->amGoingTo('Log with user registrated in RegisterPage test');
		$I->submitForm('#loginForm', array(
			 'email' => 'testuser2@website.com',
			 'password' => 'Test123Test'
		));
		$I->amGoingTo('User is logged');
		$I->see('Welcome to Shopping list');
    }
	
	/* Login as administrator */
    public function logAsAdministrator(AcceptanceTester $I){
		$I->amOnPage('/');
		$I->click('Login');  
		$I->seeElement('#loginForm');

		$I->amGoingTo('Log in as administrator');
		$I->submitForm('#loginForm', array(
			 'email' => 'testadmin@mail.com',
			 'password' => 'testpassword123'
		));
		$I->amGoingTo('Login is successfull');
		$I->see('You are logged in!');
    }
}
