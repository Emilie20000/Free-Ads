@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="profile-container">
    <h2>Profil</h2>
        <p><strong>Nom : </strong>{{ $user->name }}</p>
        <p><strong>Email : </strong>{{ $user->email }}</p>
        <p><strong>Membre depuis le : </strong>{{ $user->created_at->formatLocalized('%d %B %Y') }}</p><br>
        <div class="button-container">
        <a class="button" href="{{ route('users.edit', ['user' => $user->id]) }}">Modifier mes informations</a>
            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="button" type="submit">Supprimer mon compte</button>
            </form>
        </div>
        </div>
        <div>
        <h2>Mes annonces</h2>
        @if ($user->ads->count() > 0)
            <div class="ads-container">
                @foreach ($user->ads as $ad)
                
                    <div class="ad-card">
                        <h3>{{ $ad->title }}</h3>
                        <div class="ad-content">
                            <div class="ad-pictures">
                        @if($ad->pictures)
                            @foreach(json_decode($ad->pictures) as $picture)
                                <img src="{{ asset('storage/' . $picture) }}" alt="Photos de l'annonce" width="200">
                            @endforeach
                        @else
                            <span>Aucune photo disponible</span>
                        @endif
                        </div>
                        <div class="ad-details">
                        <p>{{ $ad->description }}</p>
                        <p>{{ number_format($ad->price, 2, ',', ' ') }}	&#8364; </p>
                        <p>Ajouté le : {{ $ad->created_at->formatLocalized('%d %B %Y') }}</p>
                        <div class="button-container">
                        <a class="button" href="{{ route('ads.edit', ['ad' => $ad->id]) }}">Modifier</a><br>
                            <form action="{{ route('ads.destroy', ['ad' => $ad->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button">Supprimer</button>
                            </form>
                        </div>
                        </div>
                        </div>
                    </div>
                    
                @endforeach
            </div>
            <div class="button-container">
                <a class="button" href="{{ route('ads.create') }}">Ajouter une annonce</a><br>
            </div>
        @else
            <p>Aucune annonce pour le moment</p><br>
            <div class="button-container">
                <a class="button" href="{{ route('ads.create') }}">Créer une annonce</a><br>
            </div>
            
        @endif
       
       
    </div>

        
</div>
 @endsection