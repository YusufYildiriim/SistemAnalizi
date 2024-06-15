@extends('layouts.front')

@section('content')
<div class="container mt-5">
    <h1>Tartışma Ekle</h1>
    <form action="{{ route('discussions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Başlık</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="body">İçerik</label>
            <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gönder</button>
    </form>
</div>
@endsection
