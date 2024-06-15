<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with('user')->latest()->get();
        return view('front.index', compact('discussions'));
    }

    public function create()
    {
        return view('front.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Discussion::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('discussions.index');
    }

    public function show($id)
    {
        $discussion = Discussion::with(['comments.user', 'user'])->findOrFail($id);
        return view('front.show', compact('discussion'));
    }


    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);

        // Sadece tartışmanın yazarı düzenleyebilir
        if ($discussion->user_id !== Auth::id()) {
            abort(403, 'Bu işlem için yetkiniz bulunmamaktadır.');
        }

        return view('front.edit', compact('discussion'));
    }

    public function update(Request $request, $id)
    {
        $discussion = Discussion::findOrFail($id);

        // Sadece tartışmanın yazarı güncelleyebilir
        if ($discussion->user_id !== Auth::id()) {
            abort(403, 'Bu işlem için yetkiniz bulunmamaktadır.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $discussion->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('discussions.show', $discussion->id)->with('success', 'Tartışma başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $discussion = Discussion::findOrFail($id);

        // Sadece tartışmanın yazarı silebilir
        if ($discussion->user_id !== Auth::id()) {
            abort(403, 'Bu işlem için yetkiniz bulunmamaktadır.');
        }

        $discussion->delete();

        return redirect()->route('discussions.index')->with('success', 'Tartışma başarıyla silindi.');
    }
}

