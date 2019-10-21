<?php 

class RegisterPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }
	
	/* See if register page exists */	
    public function registerPageExists(AcceptanceTester $I){
        $I->amOnPage('/register');
    }
	
	/* Check for heading */
	public function registerHeading(AcceptanceTester $I){
        $I->amOnPage('/register');
        $I->see('Create a new profile to start using our application');  
    }
	
	/* Try to register on page */
	public function tryToRegister(AcceptanceTester $I){
        $I->amOnPage('/register');
		/* Fill required fields */
		$I->submitForm('#registerForm', array(
			 'name' => 'Test User',
			 'email' => 'testuser2@website.com',
			 'password' => 'Test123Test',
			 'password_confirmation' => 'Test123Test'
		));
		$I->see('Welcome to Shopping list');
    }

	/* Try to register on page with different password and confirm password fiels */
	public function tryToRegisterWithError(AcceptanceTester $I){
        $I->amOnPage('/register');
		/* Fill required fields */
		$I->submitForm('#registerForm', array(
			 'name' => 'Test User',
			 'email' => 'testuser2@website.com',
			 'password' => 'Test123Test',
			 'password_confirmation' => 'Test123Test123'
		));
		$I->see('The email has already been taken');
    }
}
