<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Butonun boyutunu ve yerleşimini navbara uyarlamak için CSS */
        .navbar-nav .nav-item .custom-button {
            border: 2px solid #24b4fb;
            background-color: #24b4fb;
            border-radius: 0.9em;
            padding: 0.5em 1em;
            transition: all ease-in-out 0.2s;
            font-size: 14px;
            margin-right: 15px;
        }

        .navbar-nav .nav-item .custom-button span {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-weight: 600;
        }

        .navbar-nav .nav-item .custom-button:hover {
            background-color: #0071e2;
        }

        /* Hoşgeldiniz kısmını tıklanabilir yapmak için */
        .navbar-text {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('homepage') }}">Anasayfa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Kayıt Ol</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link custom-button" href="{{ route('discussions.create') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                                </svg>
                                Tartışma Ekle
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="navbar-text mr-3" href="{{ route('dashboard') }}">
                            Hoşgeldiniz, {{ Auth::user()->name }} {{ Auth::user()->surname }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Çıkış Yap
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <!-- Bootstrap JS ve jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
