<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classwork extends Model
{
    use HasFactory;

    const TYPE_ASSIGNMENT = 'assignment'; 
    const TYPE_MATERIAL = 'material';
    const TYPE_QUESTIONS = 'question';

    const STATUS_PUBLISHED = 'Published';
    const STATUS_DRAFT = 'Draft';



    protected $fillable = [
        'classroom_id', 'user_id', 'topic_id', 'title', 
        'description', 'type', 'status', 'published_at', 'options'
    ];


    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withPivot(['grade' , 'submitted_at' , 'status' , 'created_at'])
        ->using(ClassworkUser::class); // to define the model of the pivot table
    }

    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')  ;
    }
}
