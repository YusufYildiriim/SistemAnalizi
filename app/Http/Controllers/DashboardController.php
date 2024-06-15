<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $discussions = Discussion::where('user_id', $user->id)->get();
        $comments = Comment::where('user_id', $user->id)->get();

        return view('front.dashboard', compact('discussions', 'comments'));
    }
}
