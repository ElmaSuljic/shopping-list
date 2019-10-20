<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yaml;

class PagesController extends Controller
{
    /* Index page of applications */
	public function index(){
		$yamlcontent = Yaml::parse(file_get_contents('homepageconfig.yml'));
        return view('pages.index')->with('ymlcontent', $yamlcontent);
    }
	
	/* Register page */
	public function signin(){
        $title = 'Create your account';
        return view('pages.signin')->with('title', $title);
    }
}
