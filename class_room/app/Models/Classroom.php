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

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    public static string $disk = 'public';

    //  fillable used to define the column we need to insert by user 
    protected $fillable = [
        'name', 'section', 'subject', 'room', 'code', 'cover_image_path', 'user_id'
    ];


    // guarded used to define the column we don't need to insert by user , the best is don't use it 
    // protected $guarded = ['id' , 'updated_at'];

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


    // local scopes => call when i need it 
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


    // Global Scope => defined to apply action to all model in dynamic

    // booted function use to define function that will applied when model has initialize 
    protected static function booted()
    {
        // static::addGlobalScope('user' , function(Builder $query){
        //     $query->where('user_id', '=' , Auth::id());
        // }); 
        static::addGlobalScope(new UserClassroomScope);

        static::observe(ClassroomObserver::class);
        // Creating , Created, Updating, Updated, Saving, Saved
        // Deleting, Deleted, Restoring, Restored, ForceDeleting, ForceDeleted
        // Retrieved
        // static::creating(function (Classroom $classroom) {
        //     $classroom->code = Str::random(8);
        //     $classroom->user_id = Auth::id();
        // });

        // static::forceDeleted(function(Classroom $classroom){
        //     static::deleteCoverImage($classroom->cover_image_path);
        // });

        // static::deleted(function(Classroom $classroom){
        //     $classroom->status = 'deleted';
        //     $classroom->save();
        // });

        // static::restored(function(Classroom $classroom){
        //     $classroom->status = 'active';
        //     $classroom->save();

        // });
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


    // Accessor => get(AttributeName)Attribute
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }


    // $classroom->cover_image_url
    // public function getCoverImageUrlAttribute($value)
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
