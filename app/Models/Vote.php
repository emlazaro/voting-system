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
        'nominee_id',
        'voter_id',
    ];

    public function nominee()
    {
        return $this->belongsTo(Nominee::class);
    }

    public function voter()
    {
        return $this->belongsTo(User::class, 'voter_id', 'id');
    }
}
