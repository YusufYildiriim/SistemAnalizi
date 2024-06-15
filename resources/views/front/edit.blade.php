@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Tartışmayı Düzenle</div>

                    <div class="card-body">
                        <form action="{{ route('discussions.update', $discussion->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Başlık:</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $discussion->title }}" required>
                            </div>

                            <div class="form-group">
                                <label for="body">İçerik:</label>
                                <textarea class="form-control" id="body" name="body" rows="5" required>{{ $discussion->body }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Tartışmayı Güncelle</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Geri</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
