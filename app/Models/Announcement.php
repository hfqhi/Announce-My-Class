<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'title',
        'content',
        'due_date',
        'type'
    ];

    // This automatically treats 'due_date' as a Carbon Date object,
    // which will make porting your vanilla PHP "Days Left" math incredibly easy!
    protected $casts = [
        'due_date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    use HasFactory;
}
