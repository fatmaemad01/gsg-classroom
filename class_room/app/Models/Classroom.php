<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Observers\ClassroomObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Scopes\UserClassroomScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;

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
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class, 'classroom_id', 'id');
    }


    // Many to many relationship => use Pivot table
    public function users()
    {
        return $this->belongsToMany(
            User::class,        // Related model
            'classroom_user',   // Pivot table
            'classroom_id',     // FK for current model in the pivot table
            'user_id',          // FK for related model in the pivot table
            'id',               // PK for current model
            'id'                // PK for related model
        )->withPivot(['role', 'created_at']);
        // ->as('join') // rename pivot property
        // ->wherePivot('role' , '=', 'teacher')   we can apply some condition

    }


    // if we need to return some user, apply some condition for user by use users function nested of define it again 
    public function teachers()
    {
        return $this->users()->wherePivot('role', '=', 'teacher');
    }


    public function students()
    {
        return $this->users()->wherePivot('role', '=', 'student');
    }


    public function join($user_id, $role = 'student')
    {
        $exists = $this->users()
            ->wherePivot('user_id', $user_id)
            ->exists();

        if ($exists) {
            throw new Exception('User already joined the classroom');
        }

        // attach insert to pivot table using relation
        return $this->users()->attach($user_id, [
            'role' => $role,
            'created_at' => now()
        ]);

        // DB::table('classroom_user')
        //     ->insert([
        //         'classroom_id' => $this->id,
        //         'user_id' => $user_id,
        //         'role' => $role,
        //         'created_at' => now(),
        //     ]);
    }


    // Accessors
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
