@extends('layouts.app')

@section('content')
    <div class="main-container">
    <div>
        @if(isset($user))
            <h1>Bienvenue, {{ $user->name }}</h1>

        @endif
    </div>    
    <form action="{{ route('ads.index') }}" method="GET" class="search-form">
        @csrf
        <div>
            <label for="search">Chercher une annonce : </label>
            <input type="text" name="search" id="search">
        </div>
        <div>
            <label for="price">Trier par prix : </label>
            <select name="price" id="price" class="button">
                <option value="">--prix--</option>
                <option value="asc">Croissants</option>
                <option value="desc">Décroissants</option>
            </select>
        </div>
        <div>
            <label for="date">Trier par date : </label>
            <select name="date" id="date" class="button">
                <option value="">--date--</option>
                <option value="asc">Croissantes</option>
                <option value="desc">Décroissantes</option>
            </select>
        </div>
        <button type="submit" class="button">Chercher</button>
    </form>
    <div class="ads-container">
    @foreach($ads as $ad)
        <div class="ad-card">
            <h3>{{ $ad->title }}</h3>
            <div class="ad-content">
            <div class="ad-pictures">
            @if($ad->pictures)
                @foreach(json_decode($ad->pictures) as $picture)
                    <img src="{{ asset('storage/' . $picture) }}" alt="Photos de l'annonce">
                @endforeach
            @else
                <span>Aucune photo disponible</span>
            @endif
            </div>
            <div class="ad-details">
            <p>{{ $ad->description }}</p>
            <p>{{ number_format($ad->price, 2, ',', ' ') }} &#8364;</p>
            <p><strong>Ajouté le : </strong>{{ $ad->created_at->formatLocalized('%d %B %Y') }}</p>
            <p><strong>Créé par : </strong>{{ $ad->user->name }}</p>
            <a href="{{ route('messages.create', ['userId' => $ad->user->id]) }}" class="button">Contacter</a>
        </div>
        </div>
        </div>
    @endforeach
    <div class="pagination">
    {{ $ads->links() }} 
    </div>
</div>
@endsection
