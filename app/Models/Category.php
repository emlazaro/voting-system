<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'max_selection',
    ];

    protected $casts = [
        'created_at' => 'datetime:M-d-Y',
    ];

    public function nominees()
    {
        return $this->hasMany(Nominee::class);
    }
}
