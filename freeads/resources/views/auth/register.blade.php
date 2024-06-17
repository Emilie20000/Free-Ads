<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
        <body>
    
                <div class="form-container">
                    <h1>Inscription</h1>

                    <div>
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div >
                                <label for="name" >Nom : </label>

                                    <input id="name" type="text" name="name" required >

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                            </div>

                            <div>
                                <label for="email" >Email : </label>

                               
                                    <input id="email" type="email" name="email" required>

                                    @error('email')
                                        <span>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                
                            </div>

                            <div>
                                <label for="password" >Mot de passe :</label>

                                    <input id="password" type="password" name="password" required>

                                    @error('password')
                                        <span>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              
                            </div>

                            <div>
                                <label for="password-confirm">Confirmer le mot de passe :</label>

                               
                                    <input id="password-confirm" type="password" name="password_confirmation" required>
                            </div>

                          
                                <div>
                                    <button type="submit" class="button">
                                       S'inscrire
                                    </button>
                                </div>
                        
                        </form>
                    </div>
           
</body>
</html>


