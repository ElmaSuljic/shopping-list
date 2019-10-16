<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Categorie;


class ArticlesController extends Controller
{
     /* See index page of categories    */
    public function index()
    {
		$articles = Article::all();
		/* Get categories to fill select dropdown */
		$categories = Categorie::all();
		$data = [
			'categories' =>$categories,
			'articles' =>$articles
		];
		return view('articles.index')->with('data', $data);
    }

    /* Create new category */
    public function create()
    {
        return view('articles.create');
    }

    /* Save new category */
    public function store(Request $request)
    {
		$this->validate($request, [
            'name' => 'required',
			'category' => 'required',
        ]);
		
        $article = new Article;
        $article->articlename = $request->input('name');
		$article->categoryId = $request->input('category');
        $article->save();
        return redirect('articles')->with('success', 'New article created');

    }


    public function show($id)
    {
       
    }

    /* Go to edit category form */
    public function edit($id)
    {
        $article = Article::where('articleId',$id)->get();
        
        /* Check if article exists before displaying */
        if (!isset($article)){
            return redirect('articles')->with('error', 'There is no article');
        }
		
		$categories = Categorie::all();
		$data = [
			'categories' =>$categories,
			'article' =>$article[0]
		];
        return view('articles.edit')->with('data', $data);
    }

    /* Save changes on selected article */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
			'category' => 'required',
        ]);

 
		/* Collect article that needs to be edited */
        $art = Article::where('articleId',$id)->get();
		$article = $art->first();
        $article->articlename = $request->input('name');
		$article->categoryId = $request->input('category');
        $article->save();

        return redirect('articles')->with('success', 'Post Updated');
    }

    /*Delete selected category */
    public function destroy($id)
    {
		/* Collect article that needs to be deleted */
		$art = Article::where('articleId',$id)->get();
		$article = $art->first();
        
        /* Check to see if article exists - if not return error */
        if (!isset($article)){
            return redirect('categories')->with('error', 'There is no article!');
        }
		/* Delete category */	
        $article->delete();
        return redirect('articles')->with('success', 'Selected article deleted!');
    }
}
