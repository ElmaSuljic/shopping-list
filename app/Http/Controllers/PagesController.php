<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /* Index page of applications */
	public function index(){
        $title = 'Welcome To Shopping list!';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }
	
	/* Register page */
	public function signin(){
        $title = 'Create your account';
        return view('pages.signin')->with('title', $title);
    }
}
