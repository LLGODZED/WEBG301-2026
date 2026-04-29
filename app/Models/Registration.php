<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'conference_session_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conferenceSession()
    {
        return $this->belongsTo(ConferenceSession::class);
    }
}
