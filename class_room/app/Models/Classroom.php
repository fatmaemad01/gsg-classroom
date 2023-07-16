<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;

    public static string $disk = 'public';

    //  fillable used to define the column we need to insert by user 
    protected $fillable = [
        'name', 'section', 'subject', 'room', 'code', 'cover_image_path'
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
        return Storage::disk(Classroom::$disk)->delete($path);
    }


    // public function getCoverImagePathAttribute()
    // {
    //     if (!$this->cover_img) {
    //         return asset('./img/1.jpg');
    //     }
    //     if (Str::startsWith($this->cover_img, ['http://', 'https://'])) {
    //         return $this->cover_img;
    //     }
    //     return Storage::disk('public')->url('covers/'.$this->cover_image_path);
    // }
    
    
}
