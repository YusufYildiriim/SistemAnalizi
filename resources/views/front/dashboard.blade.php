<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    @include('front.navbar')

    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Kontrol Paneline Hoş Geldiniz.</h1>
            <p class="lead">Tartışmalarınızı ve yorumlarınızı buradan yönetin.</p>
            <hr class="my-4">
            <a href="{{ route('discussions.create') }}" class="btn btn-success mb-3">Yeni Bir Tartışma Oluşturun</a>

            <h2>Oluşturduğunuz Tartışmalar</h2>
            @if($discussions->isEmpty())
                <p>Henüz Bir Tartışma Oluşturmadınız.</p>
            @else
                <ul class="list-group mb-4">
                    @foreach($discussions as $discussion)
                        <li class="list-group-item">
                            <a href="{{ route('discussions.show', $discussion->id) }}">{{ $discussion->title }}</a>
                            <div class="float-right">
                                <a href="{{ route('discussions.edit', $discussion->id) }}" class="btn btn-primary btn-sm">Düzenle</a>
                                <form action="{{ route('discussions.destroy', $discussion->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bu Tartışmayı Silmek İstediğinize Emin Misiniz?')">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

            <h2>Yorumlarınız</h2>
            @if($comments->isEmpty())
                <p>Henüz Bir Tartışmaya Yorum Yapmadınız.</p>
            @else
                <ul class="list-group">
                    @foreach($comments as $comment)
                        <li class="list-group-item">
                            <p>{{ $comment->body }}</p>
                            <small><a href="{{ route('discussions.show', $comment->discussion->id) }}">{{ $comment->discussion->title }}</a> üstünde</small>
                            <div class="float-right">
                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary btn-sm">Düzenle</a>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bu Yorumu Silmek İstediğinize Emin Misiniz?')">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
