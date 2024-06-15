@extends('layouts.front')

@section('content')
    <div class="container">
        <h1 class="mt-5 mb-4">Forum</h1>

        <!-- İçerik Listesi -->
        <div class="row">
            <div class="col-md-8">
                <div class="list-group">
                    @foreach($discussions as $discussion)
                        <a href="{{ route('discussions.show', ['id' => $discussion->id]) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $discussion->title }}</h5>
                                <small>{{ $discussion->created_at->format('d F Y') }}</small>
                            </div>
                            <p class="mb-1">{{ \Illuminate\Support\Str::limit($discussion->body, 100, '...') }}</p>
                            <small>Yazar: {{ $discussion->user->name }}</small>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
