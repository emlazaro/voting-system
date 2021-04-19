<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Nominee;
use App\Models\Category;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nominee_id',
        'category_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function nominee()
    {
        return $this->hasOne(Nominee::class);
    }

    public function category()
    {
        return $this->hasOneThrough(Category::class, Nominee::class);
    }
}
