<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // Security: Allow these columns to be saved via forms
    protected $fillable = [
        'user_id',
        'name',
        'code',
        'schedule_time',
        'schedule_days'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    use HasFactory;
}
