<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //mass assignment
     protected $fillable = ['user_id', 'title', 'description','author', 'dateOfPublication'];
     
     public function user()
    {
      return $this->belongsTo(User::class);
    }

     public function ratings()
    {
      return $this->hasMany(Rating::class);
    }
}
