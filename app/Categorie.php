<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
	 protected $primaryKey = 'categoryId';
	 
	 public function article(){
        return $this->hasMany('App\Article','articleId', 'articleId');
    }
}
