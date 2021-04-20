<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Nominee;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class VotesController extends Controller
{
    public function index()
    {
        return Inertia::render('Votes/Index', [
            'Categories' => Category::with('nominees.user', 'nominees.votes')->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            '*nominee_id' => 'required|string'
        ]);
        foreach ($request->ballot as $vote) {
            Vote::create($vote);
        }


        $user = User::find($request->voter_id);
        $user->update(['status' => 'voted']);
        $user->save();

        return redirect()->back()->with(['success', 'Votes has been submitted!']);
    }

    public function show(Vote $vote)
    {
        return Inertia::render('Votes/Results', [
            'Categories' => Category::with('nominees.user', 'nominees.votes')->get()
        ]);
    }

    public function edit(Vote $vote)
    {
        //
    }

    public function update(Request $request, Vote $vote)
    {
        //
    }

    public function destroy(Vote $vote)
    {
        //
    }
}
