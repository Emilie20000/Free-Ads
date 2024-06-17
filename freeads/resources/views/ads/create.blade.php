@extends('layouts.app')

@section('content')
    <div class="form-container">
    <h1>Créer une annonce</h1>
    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Titre :</label>
            <input type="text" name="title" id="title" required>
        </div><br>
        <div>
            <label for="description">Description :</label>
            <textarea name="description" id="description"></textarea>
        </div><br>
        <div>
            <label for="price">Prix :</label>
            <input type="number" name="price" id="price">
        </div><br>
        <div>
            <label for="pictures">Photos :</label>
            <input class="button" type="file" name="pictures[]" id="pictures" accept="image/*" multiple>
            
        </div><br>
        <button type="submit" class="button">Ajouter l'annonce</button>
    </form>
</div>
@endsection
