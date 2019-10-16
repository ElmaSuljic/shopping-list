<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		/* Check to see if user is administrator  */
		$type = auth()->user()->usertype;
		if(($type  == 'user')){
            return redirect('/home')->with('error', 'You are not authorized to see that page!');
        } 
		$registrated = User::where('usertype','user')->get();	
		$administrators = User::where('usertype','administrator')->get();	
		$data = [
			'registrated' =>$registrated,
			'administrators' =>$administrators
		];
        return view('users.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /* Save new user */
    public function store(Request $request)
    {
		$this->validate($request,[
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'password_confirmation' => 'required',
        ]);
		
        /* Check to see if adding new administrator */
		if($request->input('addadmin')){
			if($request->input('password') != $request->input('password_confirmation')){
				return redirect('/users')->with('error', 'Fields password and confirm password do not match!');
			}
			$admin = new User;
			$admin->name = $request->input('name');
			$admin->email = $request->input('email');
			$admin->password = Hash::make($request->input('password'));
			$admin->usertype = 'administrator';
			$admin->save();
			return redirect('users')->with('success', 'New administrator added!');
		}
    }

    /* Collect user data   */
    public function show($id)
    {
		$user = User::find($id);
		if($user->usertype == 'user'){
			$admin = 'false';
		}else{
			$admin = 'true';
		}
		$data = array(
			'id'  => $user->id,
			'name'  => $user->name,
			'email'  => $user->email,
			'admin'  => $admin,
		);

		echo json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /* Function for updating users table */
    public function update(Request $request, $id)
    {
		/* Check to see if user is administrator  */
		$type = auth()->user()->usertype;
		if(($type  == 'user')){
            return redirect('/home')->with('error', 'You are not authorized to see that page!');
        } 
        /* Make registrated user an admin */
		if($request->input('makeadmin')){
			$user = User::find($id);
			$user->usertype = 'administrator';
			$user->save();
			return redirect('users')->with('success', 'User saved as administrator!');
		}
		
		/* Edit admin */
		if($request->input('editadmin')){
			$user = User::find($id);
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			if($request->input('isadmin')){
				$user->usertype = 'administrator';
			}else{
				$user->usertype = 'user';
			}
			$user->save();
			return redirect('users')->with('success', 'Changes saved!');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		/* Check to see if you want to delete your self */
        $user_id = auth()->user()->id;
        if($user_id == $id){
			return redirect('/users')->with('error', 'You can not delete yourself');
		}
		
		$user = User::find($id);
        
        /* Check does categorie exists - if not return error */
        if (!isset($user)){
            return redirect('users')->with('error', 'User does not exist!');
        }
		/* Delete category */	
        $user->delete();
        return redirect('users')->with('success', 'Selected user deleted!');
    }
}
