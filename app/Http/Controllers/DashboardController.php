<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Category;
use App\Models\Nominee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'Users' => User::all(),
            'Votes' => Vote::with('user')->distinct()->count('voter_id'),
            'Categories' => Category::with('nominees.user', 'nominees.votes')->get(),
            'Nominees' => Nominee::all(),
        ]);
    }
}
