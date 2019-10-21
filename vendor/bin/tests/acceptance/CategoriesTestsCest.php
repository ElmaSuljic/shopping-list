<?php 
use \Codeception\Util\Locator;

class CategoriesTestsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    /* Try to access categories page when not logged in*/
    public function categoriesIndexNotLogged(AcceptanceTester $I){
		$I->amOnPage('/categories'); 
		$I->amGoingTo('Redirect user to start page because he is not logged');
        $I->amOnPage('/');
        $I->see('Welcome to shopping list home page');  
    }
	
    /* Try to access categories page when not logged in as admin*/
    public function categoriesIndexLoggedAsUser(AcceptanceTester $I){
		$I->amOnPage('/');
		$I->click('Login');  
		$I->seeElement('#loginForm');

		$I->amGoingTo('Log with user registrated in RegisterPage test');
		$I->submitForm('#loginForm', array(
			 'email' => 'testuser2@website.com',
			 'password' => 'Test123Test'
		));
		$I->amGoingTo('User is logged and trying to access categories page');
		
		$I->amOnPage('/categories'); 
		$I->amGoingTo('Redirect user to dashboard because he is not logged');
        $I->amOnPage('/dashboard');
        $I->see('Welcome to Shopping list');
    }
	
    /* Try to access categories page as admin*/
    public function categoriesIndexLoggedAsAdmin(AcceptanceTester $I){
		$I->amOnPage('/');
		$I->click('Login');  
		$I->seeElement('#loginForm');

		$I->amGoingTo('Log with admin');
		$I->submitForm('#loginForm', array(
			 'email' => 'testadmin@mail.com',
			 'password' => 'testpassword123'
		));
		$I->amGoingTo('Login is successfull');
		$I->see('You are logged in!');
		
		
		$I->amGoingTo('Admin is trying to access categories page');
		$I->click('#categoriesBtn');
		
		$I->amOnPage('/categories'); 
		$I->see('Categories');
    }
	
    /* Try to add new category as admin*/
    public function addNewCategory(AcceptanceTester $I){
		$I->amOnPage('/');
		$I->click('Login');  
		$I->seeElement('#loginForm');

		$I->amGoingTo('Log with admin');
		$I->submitForm('#loginForm', array(
			 'email' => 'testadmin@mail.com',
			 'password' => 'testpassword123'
		));
		$I->amGoingTo('Login is successfull');
		$I->see('You are logged in!');
		
		
		$I->amGoingTo('Admin is trying to access categories page');
		$I->click('#categoriesBtn');
		
		$I->amOnPage('/categories'); 
		$I->see('Categories');
		
		$I->amGoingTo('Add new category');
		$I->click('#activateAdd');
		$I->submitForm('#addCategoryForm', array(
			 'name' => 'New category'
		));
    }
	
    /* Try to edit category as admin*/
    public function editCategory(AcceptanceTester $I){
		$I->amOnPage('/');
		$I->click('Login');  
		$I->seeElement('#loginForm');

		$I->amGoingTo('Log with admin');
		$I->submitForm('#loginForm', array(
			 'email' => 'testadmin@mail.com',
			 'password' => 'testpassword123'
		));
		$I->amGoingTo('Login is successfull');
		$I->see('You are logged in!');
		
		
		$I->amGoingTo('Admin is trying to access categories page');
		$I->click('#categoriesBtn');
		
		$I->amOnPage('/categories'); 
		$I->see('Categories');
		
		
		$I->amGoingTo('find Edit button for previously added category - last row in table, second to last column');
		$I->click(Locator::elementAt('//table/tbody/tr/td', -2));
		$I->amGoingTo('check if I see form for editing category');
		$I->see('Edit category');
		$I->amGoingTo('update my data');
		$I->submitForm('#formeditaction', array(
			 'name' => 'New category 2'
		)); 
    }
	
    /* Try to delete added category as admin*/
    public function deleteCategory(AcceptanceTester $I){
		$I->amOnPage('/');
		$I->click('Login');  
		$I->seeElement('#loginForm');

		$I->amGoingTo('Log with admin');
		$I->submitForm('#loginForm', array(
			 'email' => 'testadmin@mail.com',
			 'password' => 'testpassword123'
		));
		$I->amGoingTo('Login is successfull');
		$I->see('You are logged in!');
		
		
		$I->amGoingTo('Admin is trying to access categories page');
		$I->click('#categoriesBtn');
		
		$I->amOnPage('/categories'); 
		$I->see('Categories');
		
		
		$I->amGoingTo('find Delete button for previously added category - last row in table, last column');
		$I->click(Locator::elementAt('//table/tbody/tr/td', -1));
		$I->amGoingTo(" not delete item because javascript confirm does not work with PHPBrowser");

		
    }
}
