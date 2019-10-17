<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listarticle extends Model
{
    protected $primaryKey = 'id';
	 
	/* Assugned to just one article */ 
	public function article(){
        return $this->belongsTo('App\Article','articleId', 'articleId');
    }
	
	/* Assugned to just one list */
	public function lista(){
        return $this->belongsTo('App\Liste','listId', 'listId');
    }
}
