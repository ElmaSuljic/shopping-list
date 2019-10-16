<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;

class CategoriesController extends Controller
{
    /* See index page of categories    */
    public function index()
    {
		/* Check to see if user is administrator */
		if((Auth::user()->usertype == 'user')){
            return redirect('/home')->with('error', 'You are not authorized to see that page!');
        }
		
		$categories = Categorie::all();
		$data = ['categories' =>$categories];
        return view('categories.index')->with('data', $data);
    }

    /* Create new category */
    public function create()
    {
        return view('categories.create');
    }

    /* Save new category */
    public function store(Request $request)
    {
		$this->validate($request, [
            'name' => 'required'
        ]);
        $categorie = new Categorie;
        $categorie->categoryname = $request->input('name');
        $categorie->save();
        return redirect('categories')->with('success', 'Post Created');

    }

	/* Get categorie details for ajax display */
    public function show($id)
    {
		$cat = Categorie::where('categoryId',$id)->get();
		$categorie = $cat->first();
		$data = array(
			'id'  => $categorie->categoryId,
			'name'  => $categorie->categoryname,
		);

		echo json_encode($data);
    }

    /* Go to edit category form */
    public function edit($id)
    {
        $categorie = Categorie::where('categoryId',$id)->get();
        
        //Check if post exists before deleting
        if (!isset($categorie)){
            return redirect('/categories')->with('error', 'There is no category');
        }
		/* return  $categorie; */
        return view('categories.edit')->with('categorie', $categorie);
    }

    /* Save changes on category */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

 
		/* Collect caterorie needed to be edited */
        $cat = Categorie::where('categoryId',$id)->get();
		$categorie = $cat->first();
        $categorie->categoryname = $request->input('name');
		$categorie->save();

        return redirect('categories')->with('success', 'Post Updated');
    }

    /*Delete selected category */
    public function destroy($id)
    {
		/* Collect categorie that needs to be deleted */
		$cat = Categorie::where('categoryId',$id)->get();
		$categorie = $cat->first();
        
        /* Check does categorie exists - if not return error */
        if (!isset($categorie)){
            return redirect('categories')->with('error', 'There is no category!');
        }
		/* Delete category */	
        $categorie->delete();
        return redirect('categories')->with('success', 'Selected category deleted!');
    }
	
}
