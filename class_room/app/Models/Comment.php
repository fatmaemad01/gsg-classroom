<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'commentable_id', 'commentable_type', 'content', 'ip', 'user_agent'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            "name" => "Deleted User",
        ]);
    }


    // function name as the morph column in the comments table 
    public function commentable()
    {
        return $this->morphTo();
    }


}

