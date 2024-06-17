<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Ads</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="form-container welcome">
    <h1>Bienvenue sur Free Ads</h1>
    <p>Pour continuer inscrivez-vous ou connectez-vous</p>
    <div class="button-container">
        <a class="button" href="{{ route('users.create') }}">Inscription</a>
        <a class="button" href="{{ route('login') }}">Connexion</a>
    </div>
    
    </div>
    
</body>
</html>
