<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory ;

    public $timestamps = false;

    
    protected $fillable = ['name','user_id','classroom_id'];


    public function classroom()
    {
        return $this->belongsTo(Classroom::class , 'classroom_id' , 'id');
    }


    public function classworks()
    {
        return $this->hasMany(Classwork::class , 'topic_id' , 'id');
    }
}
