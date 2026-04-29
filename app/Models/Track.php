<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color', 'description'];

    public function sessions()
    {
        return $this->hasMany(ConferenceSession::class);
    }
}
