<?php

namespace App\Models;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stream extends Model
{
    use HasFactory, HasUuids;

    // HasUuids by default define this 2 variable
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'classwork_id', 'post_id', 'user_id', 'content', 'classroom_id', 'link'
    ];

    public function getUpdatedAtColumn()
    {
    }

    // public function setUpdatedAt($value)
    // {

    // }

    protected static function booted()
    {
        // static::creating(function(Stream $stream){
        //     $stream->id = Str::uuid();
        // });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
