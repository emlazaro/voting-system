<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'nominated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime:M-d-Y',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function votes()
    {
        return $this->hasManyThrough(Vote::class, User::class);
    }
}
