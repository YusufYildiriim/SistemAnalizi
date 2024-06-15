@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $discussion->title }}</h1>
        <p>{{ $discussion->body }}</p>

        <hr>

        <h2>Yorumlar</h2>
        @foreach ($discussion->comments as $comment)
            <div class="comment">
                <p>{{ $comment->content }}</p>
                <p><small>{{ $comment->user->name }} tarafından {{ $comment->created_at->diffForHumans() }} tarihinde gönderildi</small></p>
                @if (Auth::check() && Auth::id() == $comment->user_id)
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-warning">Düzenle</a>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                    </form>
                @endif
                <hr>
            </div>
        @endforeach

        @auth
            <form action="{{ route('comments.store', $discussion->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">Yorum Yaz:</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Yorum Gönder</button>
            </form>
        @endauth
    </div>
@endsection
