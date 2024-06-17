@extends('layouts.app')

@section('content')
<div>
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <h2>Modifier votre profil</h2>
        <div>
            <h4>Modifier votre nom</h4>
            <label for="name">Saisissez votre nouveau nom : </label>
            <input type="text" name="name" id="name"  value="{{ $user->name }}"><br>
        </div>
        <div>
            <h4>Modifier votre email</h4>
            <label for="email">Saisissez votre nouvel email : </label>
            <input type="email" name="email" id="email" value="{{ $user->email }}"><br>
        </div>
        <div>
            <h4>Modifier votre mot de passe : </h4>
            <div>
                <label for="currentPassword">Saisissez votre ancien mot de passe : </label><br>
                <input type="password" name="current_password" id="currentPassword"><br>
            </div>
            <div>
                <label for="newPassword">Saisissez votre nouveau mot de passe : </label><br>
                <input type="password" name="new_password" id="newPassword"><br>
            </div>
        </div>
        <button type="submit" class="button">Modifier mes informations</button>
    </form>
</div>
@endsection
