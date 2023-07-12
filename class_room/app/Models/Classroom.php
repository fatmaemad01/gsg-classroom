<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    //  fillable used to define the column we need to insert by user 
    protected $fillable = [
        'name' ,'section','subject','room','code','cover_image_path'
    ];

    // guarded used to define the column we don't need to insert by user , the best is don't use it 
    // protected $guarded = ['id' , 'updated_at'];
}
