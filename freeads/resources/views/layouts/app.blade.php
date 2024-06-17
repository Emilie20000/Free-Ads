<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Ads</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <header>
        <nav class="navbar">
                <h1>Free Ads</h1>
                <div class="navbar-nav">
                    <a href="{{ route('ads.index') }}">Accueil</a>
                    <a href="{{ route('messages.index') }}">Messagerie</a>
                    <a href="{{ route('users.show', ['user' => Auth::id()]) }}">Mon compte</a><br>
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="button logout" type="submit">Déconnexion</button>
                    </form>
                </div>
           
        </nav>
    </header>
    <main class="main">
        @yield('content')
</main>
</body>
</html>
