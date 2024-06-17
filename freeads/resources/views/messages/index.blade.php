@extends('layouts.app')

@section('content')
<div class="main-container">
    <h1>Boîte de réception</h1>
    <p class="unread-count">{{ $unreadCount }} message(s) non lu(s)</p>

    @if ($messages->count() > 0)
    <div>
        @foreach ($messages as $message)
        <div class="message-item">
            @if($message->is_read)
            <p class="message-read">Lu</p>
            @else
            <p class="message-new"><strong>Nouveau</strong></p>
            @endif
            <strong>Message de : {{ $message->sender->name }}</strong>
            <p>Envoyé le {{ $message->created_at->format('d/m/Y H:i') }}</p>
            <a class="button" href="{{ route('messages.show', ['message' => $message->id]) }}">Voir le message</a>
        </div>
        @endforeach
    </div>
    @else
    <p class="no-messages">Aucun message reçu pour le moment.</p>
    @endif
</div>
@endsection
