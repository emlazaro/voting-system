<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Nominee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NomineeController extends Controller
{
    public function index()
    {
        return Inertia::render('Nominees/Index', [
            'Nominees' => Nominee::with(['user', 'category', 'votes'])->orderBy('category_id')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Nominees/Create', [
            'Users' => User::doesntHave('nomination')->get(),
            'Categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'user_id' => ['required'],
            'category_id' => ['required'],
        ]);

        $nominee = Nominee::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        return Redirect::route('nominees')->with(['success' => 'Nominee Created...']);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, Nominee $nominee)
    {
        //
    }

    public function destroy(Nominee $nominee)
    {
        $nominee->delete();

        return redirect()->route('nominees')->with(['success' => 'Nominee data has been deleted']);
    }
}
