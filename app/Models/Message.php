<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use tidy;

class Message extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'recipient_id', 'recipient_type', 'sender_id', 'body'
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->morphTo();
    }
}
