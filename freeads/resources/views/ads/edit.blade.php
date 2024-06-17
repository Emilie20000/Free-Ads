@extends('layouts.app')

@section('content')
    <div class="form-container">
        <form action="{{ route('ads.update', ['ad' => $ad->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Titre :</label>
                <input type="text" name="title" id="title" value="{{ old('title', $ad->title) }}">
            </div>
            <div>
                <label for="description">Description :</label>
                <textarea name="description" id="description">{{ old('description', $ad->description) }}</textarea>
            </div>
            <div>
                <label for="price">Prix :</label>
                <input type="number" name="price" id="price" value="{{ old('price', $ad->price) }}">
            </div>
            <div>
                <label for="pictures">Photos :</label>
                <input type="file" class="button" name="pictures[]" id="pictures" accept="image/*" multiple>
            </div>
            <button type="submit" class="button">Enregistrer les modifications</button>
        </form>
    </div>
@endsection
