<?php

namespace App\Models;

use App\Enums\ClassworkType;
// use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classwork extends Model
{
    use HasFactory;

    const TYPE_ASSIGNMENT =  ClassworkType::TYPE_ASSIGNMENT->value;
    const TYPE_MATERIAL =  ClassworkType::TYPE_MATERIAL->value;
    const TYPE_QUESTIONS = ClassworkType::TYPE_QUESTIONS->value;

    const STATUS_PUBLISHED = 'Published';
    const STATUS_DRAFT = 'Draft';



    protected $fillable = [
        'classroom_id', 'user_id', 'topic_id', 'title',
        'description', 'type', 'status', 'published_at', 'options'
    ];

    protected $casts = [
        'options' => 'array',
        'classroom_id ' => 'integer',
        'published_at' => 'date',
        'type' => ClassworkType::class
    ];

    public static function booted()
    {
        static::creating(function (Classwork $classwork) {
            if (!$classwork->published_at) {
                $classwork->published_at = now();
            }
        });
    }


    public function scopeFilter(Builder $builder,  $filters)
    {
        $builder->when($filters['search'] ?? '', function ($builder, $value) {
            $builder->where(function ($builder) use ($value) {
                $builder->where('title', 'LIKE', "%{$value}%")
                    ->orWhere('description', 'LIKE', "%{$value}%");
            });
        })
            ->when($filters['type'] ?? '', function ($builder, $value) {
                $builder->where('type', '=', "%{$value}%");
            });
    }

    public function getPublishedDateAttribute()
    {
        if ($this->published_at) {
            return $this->published_at->format('Y-m-d');
        }
    }


    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['grade', 'submitted_at', 'status', 'created_at'])
            ->using(ClassworkUser::class); // to define the model of the pivot table
    }


    // Classwork Model
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function stream()
    {
        return $this->hasOne(Stream::class, 'classwork_id', 'id')->withDefault(); // with hasOne and belongsTo
    }
}
