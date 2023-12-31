<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    // here we define set & get in the same method
    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtolower($value)
        );
    }

    // Many to many => relation (teacher or student ) with classroom
    public function classrooms()
    {
        return $this->belongsToMany(
            Classroom::class,
            'classroom_user',
            'user_id',
            'classroom_id',
            'id',
            'id'
        )
            ->withPivot(['role', 'created_at']);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // One to many => relation between owner of the classroom
    public function createdClassroom()
    {
        return $this->hasMany(Classroom::class, 'user_id');
    }


    public function classworks()
    {
        return $this->belongsToMany(Classwork::class)->withPivot(['status', 'grade', 'submitted_at', 'created_at'])->using(ClassworkUser::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')->withDefault(); // with hasOne and belongsTo
    }

    public function receivedMessages()
    {
        return $this->morphMany(Message::class, 'recipient');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }


    // this is default when felid name is email, but if we have another felid name we must define it
    public function routeNotificationForMail($notification = null)
    {
        return $this->email;
    }

    public function routeNotificationForVonage($notification = null)
    {
        // return $this->phone;
        return '972594117270';
    }

    public function routeNotificationForHadara($notification = null)
    {
        return '021548745';
    }
}
