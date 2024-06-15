<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;

class UserController extends Controller
{
    public function home(){
        $discussions = Discussion::with('user')->latest()->get();
        return view('front.homepage', compact('discussions'));
    }


}
