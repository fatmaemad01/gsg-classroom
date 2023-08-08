<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

   protected $fillable = ['user_id' , 'classroom_id' , 'content'];

   public function user()
   {
        return $this->belongsTo(User::class);
   }

   public function classroom()
   {
        return $this->belongsTo(Classroom::class);
   }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')  ;
    }

}
