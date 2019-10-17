<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
		/* Check to see if user is administrator  */
		$type = auth()->user()->usertype;
		if(($type  == 'user')){
            return redirect('dashboard');
        } 
		
        return view('home');
    }
	
	/* Open logged user dashboard */
	public function dashboard()
    {
        return view('dashboard');
    }
}
