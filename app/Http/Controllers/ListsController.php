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

    /* Create new List */
	
    public function create(){
		$categories = Categorie::all();
		$data = ['categories' =>$categories];
        return view('lists.create')->with('data', $data);
    }

    /* Save new list and its data */
	
    public function store(Request $request){
		$userid = auth()->user()->id;
		/* Check to see if required fields are filled */
		$this->validate($request, [
            'name' => 'required'
        ]);
		/* Create instance of a list */
		$liste = new Liste;
        $liste->listname = $request->input('name');
		$liste->userId = $userid;
        $liste->save();
		$listid = $liste->listId;
		/* Collect list items */
		$listarticles = explode(';',$request->input('articlelist'));
		
		/* Save list items to table listarticles */
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

	/* Show list - list is displayed through ajax request*/
    public function show($id){
		
    }

    /* Go to edit list page */
	
    public function edit($id){
		
        $lists = Liste::where('listId',$id)->get();
		$list = $lists->first();
        $categories = Categorie::all();
		$data = [
			'list' =>$list,
			'categories' =>$categories
		];
        
        return view('lists.edit')->with('data', $data);
    }

    /* Save changes on list */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

 
		/* Collect list needed to be edited */
        $lists = Liste::where('listId',$id)->get();
		$list = $lists->first();
        $list->listname = $request->input('name');
		$list->save();
		
		$listname = $request->input('name');
		/*Update list items*/
		$listarticles = explode(';',$request->input('articlelist'));
		
		$checked = $request->input('articles[]');
		/* Save list items to table listarticles */
		for($i = 0; $i < (count($listarticles)-1); $i++){
			$articleid = $listarticles[$i];
			$listitems = Listarticle::where('listId',$id)
			->where('articleId',$articleid)
			->get();
			/* Add new list item */
			if (!isset($listitems[0])){
				$larticle = new Listarticle;
				$larticle->listId = $id;
				$larticle->articleId = $articleid;
				$larticle->quantity = 0;
				$checked = $request->input('articles'.$articleid);
				if($checked != null){
					$larticle->checked = 1;
				}else{
					$larticle->checked = 0;
				}
				$larticle->save();
			}
			/* Update previously added item */
			else{
				$listarticle = $listitems->first();
				$checked = $request->input('articles'.$articleid);
				if($checked != null){
					$listarticle->checked = 1;
				}else{
					$listarticle->checked = 0;
				}
				$listarticle->save();
			}			
		}
       return redirect('lists')->with('success', 'List is updated!');
    }

    /*Delete selected category */
    public function destroy($id)
    {

		/* Collect list that needs to be deleted */
		$lists = Liste::where('listId',$id)->get();
		$list = $lists->first();
        
        /* Check does list exists - if not return error */
        if (!isset($lists)){
            return redirect('lists')->with('error', 'There is no list!');
        }
		/* Delete list */	
        $list->delete();
		
        return redirect('lists')->with('success', 'Selected list deleted!');
    }
}
