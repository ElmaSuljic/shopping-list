<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Liste;
use App\Article;
use App\User;
use App\Categorie;
use App\Listarticle;

class AjaxsController extends Controller
{
    /* See index page of categories    */
    public function getArticles(Request $request){
		 if($request->ajax()){
			$cat = $request->get('query');
		}else{
			$cat = 1; 
		}
		
		$articles = Article::where('categoryId',$cat)->get();
		$output = '';
		if(count($articles) > 0){
			foreach($articles as $a){
				$output .= '
					<div class="form-check" id="divcheck'.$a->articleId.'">
						<input type="checkbox" class="form-check-input artikli" value="'.$a->articleId.'" id="check'.$a->articleId.'" name="articles">
						<label class="form-check-label" for="exampleCheck'.$a->articleId.'">'.$a->articlename.'</label>
					</div>
				';
		   }
		}else{
			$output = '<p>There are no articles in this category</p>';
		}
		$data = array(
			'category' => $cat,
		   'table_data'  => $output,
		);
		echo json_encode($data);
    }
	
	/* See get list and its content    */
	
    public function getList(Request $request){
		 if($request->ajax()){
			$listid = $request->get('query');
		}else{
			$listid = 1; 
		}
		
		$lists = Liste::where('listId',$listid)->get();
		$list = $lists[0];
		$articles = $list->articles;
		$output = '<div class="card">
					<div class="card-header">
					<h3 style="text-align:center;text-transform:uppercase">'.$list->listname.'</h3>
					</div>
					<div class="card-body">';
		if(count($articles) > 0){
			foreach($articles as $a){
				$output .= '
				<div class="col-sm-12">
					<div class="form-check custom-control-inline" id="divcheck'.$a->articleId.'">
						<input type="checkbox" class="form-check-input artikli" value="'.$a->articleId.'" id="check'.$a->articleId.'" name="articles">
						<label class="form-check-label" for="exampleCheck'.$a->articleId.'">'.$a->article->articlename.'</label>
					</div>
				</div>	
				';
		   }
		   $output .= '</div>
				</div>';
		}else{
			$output = '<p>There are no articles in this category</p>';
		} 
		$data = array(
		   'table_data'  => $articles,
		   'output' => $output
		);
		echo json_encode($data);
    }
}
