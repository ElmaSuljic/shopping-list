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
    /* Get all articles of specific category    */
    public function getArticles(Request $request){
		 if($request->ajax()){
			$cat = $request->get('query');
		}else{
			$cat = 1; 
		}
		
		$articles = Article::where('categoryId',$cat)->get();
		$output = '<div class="card">
					<div class="card-header">
						<h4 style="text-align:center;text-transform:uppercase">Choose items from selected category</h4>
						<small>Check items below to add them to your list.</small>
					</div>
					<div class="card-body">';
		if(count($articles) > 0){
			foreach($articles as $a){
				$output .= '
					<div class="form-check" id="divcheck'.$a->articleId.'">
						<input type="checkbox" class="form-check-input artikli" value="'.$a->articleId.'" id="check'.$a->articleId.'" name="articles">
						<label class="form-check-label" id="label'.$a->articleId.'" for="exampleCheck'.$a->articleId.'">'.$a->articlename.'</label>
					</div>
				';
		   }
		   $output .='</div>';
		}else{
			$output = '<p>There are no articles in this category</p>';
		}
		$data = array(
			'category' => $cat,
		   'table_data'  => $output,
		);
		echo json_encode($data);
    }
	
	/* Get all articles of specific category that are not already in list   */
	
    public function getArticlesNotInList(Request $request){
		if($request->ajax()){
			$listid = $request->get('listid');
			$cat = $request->get('category');
		}else{
			$listid = null;
			$cat = null;
		}
		
		$articles = Article::where('categoryId',$cat)->get();
		$output = '<div class="card">
					<div class="card-header">
						<h4 style="text-align:center;text-transform:uppercase">Choose items from selected category</h4>
						<small>Check items below to add them to your list.</small>
					</div>
					<div class="card-body">';
		if(count($articles) > 0){
			foreach($articles as $a){
				/* Check to se iff article is already in list */
				$articleid = $a->articleId;
				$listitems = Listarticle::where('listId',$listid)
				->where('articleId',$articleid)
				->get();
				if (!isset($listitems[0])){
					$output .= '
					<div class="form-check custom-control-inline" id="divcheck'.$a->articleId.'">
						<input type="checkbox" class="form-check-input artikli" value="'.$a->articleId.'" id="check'.$a->articleId.'" name="articles">
						<label class="form-check-label" id="label'.$a->articleId.'" for="exampleCheck'.$a->articleId.'">'.$a->articlename.'</label>
					</div>
				';
				}
		   }
		   $output .='</div>';
		}else{
			$output = '<p>There are no articles in this category</p>';
		}
		$data = array(
			'category' => $listitems,
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
					<p><small>Cross out item on the list after you buy it</small></p>
					</div>
					<div class="card-body">
					<input type="hidden" id="listid" value="'.$listid.'"/>';
		if(count($articles) > 0){
			$checked = 0;
			foreach($articles as $a){
				if($a->checked == 0){
				$output .= '
				<div class="col-sm-12">
					<div class="form-check custom-control-inline" id="divcheck'.$a->articleId.'">
						<input type="checkbox" class="form-check-input listarticles" value="'.$a->id.'" id="check'.$a->articleId.'" name="articles">
						<label class="form-check-label" for="exampleCheck'.$a->articleId.'">'.$a->article->articlename.'</label>
					</div>
				</div>	
				';
				}else{
					$checked++;
				}
			}
			if($checked == count($articles) ){
				$output .= '<p>You crossed out all items this list.</p>';
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
	
	public function crossFromList(Request $request){
		if($request->ajax()){
			$query = $request->get('query');
			$arg = explode(';',$query);
		}else{
			$arg = null; 
		}
		if($arg != null){
			$listarticleid = $arg[0];
			$listarticle = Listarticle::find($listarticleid);
			$listarticle->checked = 1;
			$listarticle->save();
			
			$output = 'true';
		}else{
			$output = 'false';
		} 
		$data = array(
		   'output' => $output
		);
		echo json_encode($data);
    } 
	
	/* Remove item from list */
	
	public function removeFromList(Request $request){
		if($request->ajax()){
			$listid = $request->get('listid');
			$itemid = $request->get('itemid');
		}else{
			$listid = null;
			$itemid = null;
		}
		/* Check to see if logged user is deleting item from his own list */
		$userid = auth()->user()->id;
		$lists = Liste::where('listId',$listid)->get();
		$list = $lists[0];
		if($list->userId != $userid){
			$state = 0;
			$message = 'You cannot remove item from other users list!';
		}else{
			$listitem = Listarticle::find($itemid);
			/* Check does list item exists - if not return error */
			if (!isset($listitem)){
				$state = 0;
				$message = 'Item not found';
			}else{
				/* Delete list item */	
				$listitem->delete();
				$state = 1;
				$message = 'Item deleted';
			}
		}
		
		$data = array(
		   'state' => $state,
		   'message' => $message
		);
		echo json_encode($data);
    }
}
