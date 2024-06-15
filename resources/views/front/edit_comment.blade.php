@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Yorumu Düzenle</div>

                    <div class="card-body">
                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="content">Yorum:</label>
                                <textarea class="form-control" id="content" name="content" rows="5" required>{{ $comment->content }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Yorumu Güncelle</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Geri</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
