<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{
    protected $primaryKey = 'listId';
    public function user(){
        return $this->belongsTo('App\User','id', 'userId');
    }
	
	public function articles(){
        return $this->hasMany('App\Listarticle','listId', 'listId');
    }
}
