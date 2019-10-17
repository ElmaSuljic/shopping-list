<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Liste;
use App\Article;
use App\User;
use App\Categorie;
use App\Listarticle;

class ListsController extends Controller
{
    /* See index page of lists    */
    public function index(){
		$type = auth()->user()->usertype;
		if(($type  == 'user')){
            return redirect('/home')->with('error', 'You are not authorized to see that page!');
        } 
		$userid = auth()->user()->id;
		$lists = Liste::where('userId',$userid)->get();
		
		$data = ['lists' =>$lists];
		return view('lists.index')->with('data', $data);
    }

    /* Create new category */
    public function create()
    {
		$categories = Categorie::all();
		$data = ['categories' =>$categories];
        return view('lists.create')->with('data', $data);
    }

    /* Save new category */
    public function store(Request $request)
    {
		$userid = auth()->user()->id;
		
		$this->validate($request, [
            'name' => 'required',
			'articlelist' => 'required'
        ]);
		$liste = new Liste;
        $liste->listname = $request->input('name');
		$liste->userId = $userid;
        $liste->save();
		$listid = $liste->listId;
		$listarticles = explode(';',$request->input('articlelist'));

		for($i = 0; $i < (count($listarticles)-1); $i++){
			$larticle = new Listarticle;
			$larticle->listId = $listid;
			$larticle->articleId = $listarticles[$i];
			$larticle->quantity = 0;
			$larticle->checked = 0;
			$larticle->save();
		}
		
        return redirect('lists')->with('success', 'List is added');

    }

	/* Get categorie details for ajax display */
    public function show($id)
    {
		echo 'aaas';	
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
