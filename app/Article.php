<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	 protected $primaryKey = 'articleId';
    public function category(){
        return $this->belongsTo('App\Categorie','categoryId', 'categoryId');
    }
}
