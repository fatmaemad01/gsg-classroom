<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    // default things when we use the standard names .. it's just for knowledge
    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $connection = 'mysql';

    protected $table = 'topics';
    
    protected $primaryKey = 'id';
    
    protected $keyType = 'int';

    public $incrementing = true;

    // this must be defined because we delete timestamps in topics table , true is the default. 
    public $timestamps = false;

    protected $fillable = ['name','user_id','classroom_id'];
}
