<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation de compte</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="form-container">
        <h1>Activation de compte</h1>
        <p>Merci de vous être inscrit! Veuillez cliquer sur le lien ci-dessous pour activer votre compte :</p>
            <a href="{{ $activationLink }}">Activer le compte</a>
        
        <p>Si vous n'avez pas demandé cette activation, veuillez ignorer cet e-mail.</p>
    </div>
</body>
</html>