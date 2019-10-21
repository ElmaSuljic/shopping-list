<?php 

class FirstTestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
	
	
	public function frontpageWorks(AcceptanceTester $I){
        $I->amOnPage('/');
        $I->see('Welcome to shopping list home page');  
    }
}
