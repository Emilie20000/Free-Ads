@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="message-item">
        <p><strong>De :</strong> {{ $message->sender->name }}</p>
        <p><strong>Date :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
        <hr>
        <p>{{ $message->content }}</p>
        <div class="button-container">
            <a  class="button" href="{{ route('messages.create', ['userId' => $message->sender->id]) }}">Répondre</a>
            <form action="{{ route('messages.destroy', ['message' => $message->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="button">Supprimer</button>
            </form>
        </div>
        </div>
    </div>
@endsection