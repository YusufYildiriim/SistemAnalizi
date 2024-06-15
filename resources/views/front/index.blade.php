@extends('layouts.front')

@section('content')

<div class="container">
    <h1 class="mt-5 mb-4">Forum</h1>

    <div class="list-group">
        @foreach ($discussions as $discussion)
        <a href="{{ route('discussions.show', $discussion->id) }}" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $discussion->title }}</h5>
                <small>{{ $discussion->created_at->format('d M Y') }}</small>
            </div>
            <p class="mb-1">{{ $discussion->body }}</p>
            <small>Yazar: {{ $discussion->user->name }}</small>
            @if (Auth::id() == $discussion->user_id)
            <div class="float-right">
                <a href="{{ route('discussions.edit', $discussion->id) }}" class="btn btn-sm btn-primary mr-2">Düzenle</a>
                <form action="{{ route('discussions.destroy', $discussion->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                </form>
            </div>
            @endif
        </a>
        @endforeach
    </div>

</div>

@endsection
