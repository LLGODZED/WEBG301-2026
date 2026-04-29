<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConferenceSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_time', 'end_time', 'level', 'status',
        'room_id', 'speaker_id', 'track_id', 'max_attendees'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function getRegisteredCountAttribute()
    {
        return $this->registrations()->where('status', 'registered')->count();
    }

    public function getIsFullAttribute()
    {
        return $this->registered_count >= $this->max_attendees;
    }

    public function getDateLabelAttribute()
    {
        return $this->start_time ? $this->start_time->format('D, d M Y') : '';
    }

    public function getTimeLabelAttribute()
    {
        if (!$this->start_time || !$this->end_time) {
            return '';
        }
        return $this->start_time->format('H:i') . ' - ' . $this->end_time->format('H:i');
    }
}
