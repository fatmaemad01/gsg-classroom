<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Scopes\UserClassroomScope;
use App\Observers\ClassroomObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    public static string $disk = 'public';

    protected $fillable = [
        'name', 'section', 'subject', 'room', 'code', 'cover_image_path', 'user_id'
    ];


    public function getRouteKey()
    {
        return 'id';
    }


    public static function uploadCoverImage($file)
    {
        $path = $file->store('/covers', [
            'disk' =>  static::$disk,
        ]);
        return $path;
    }

    public static function deleteCoverImage($path)
    {
        if (!$path || !Storage::disk(Classroom::$disk)->exists($path)) {
            return;
        }
        return Storage::disk(Classroom::$disk)->delete($path);
    }


    // local scopes
    public function scopeActive(Builder $query)
    {
        $query->where('status', '=', 'active');
    }

    public function scopeRecent(Builder $query)
    {
        $query->orderBy('updated_at', 'DESC');
    }


    public function scopeStatus(Builder $query, $status)
    {
        $query->where('status', '=', $status);
    }


    protected static function booted()
    {
        static::addGlobalScope(new UserClassroomScope);

        static::observe(ClassroomObserver::class);
    }

    // relations
    public function classworks(): HasMany
    {
        // classroom_id , id => optional, laravel suppose it by default
        return $this->hasMany(Classwork::class, 'classroom_id', 'id');
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class, 'classroom_id', 'id');
    }


    public function join($user_id, $role = 'student')
    {
        DB::table('classroom_user')
            ->insert([
                'classroom_id' => $this->id,
                'user_id' => $user_id,
                'role' => $role,
                'created_at' => now(),
            ]);
    }


    // Accessor 
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getSectionAttribute($value)
    {
        return strtoupper($value);
    }
    
    public function getSubjectAttribute($value)
    {
        return strtoupper($value);
    }

    // $classroom->cover_image_url
    // public function getCoverImageUrlAttribute()
    // {
    //     if ($this->cover_image_path) {
    //         return Storage::disk(static::$disk)->url($this->cover_image_path);
    //     }
    //     return asset('./img/1.jpg');
    // }

    public function getUrlAttribute()
    {
        return route('classroom.show', $this->id);
    }
}
