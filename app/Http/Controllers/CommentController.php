<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $discussionId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->discussion_id = $discussionId;
        $comment->user_id = auth()->id();
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('discussions.show', $discussionId)->with('success', 'Yorum başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('front.edit_comment', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('discussions.show', $comment->discussion_id)
                         ->with('success', 'Yorum başarıyla güncellendi!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id != Auth::id()) {
            return abort(403, 'Yetkisiz işlem.');
        }

        $comment->delete();

        return redirect()->route('discussions.show', $comment->discussion_id);
    }
}
