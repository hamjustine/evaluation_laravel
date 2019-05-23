<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function commentaires(){
    return $this->hasMany('App\Commentaire');
    }
}
