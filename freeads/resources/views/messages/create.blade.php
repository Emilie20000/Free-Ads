@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Envoyer un message</h1>
    <form action="{{ route('messages.store') }}" method="POST">
    @csrf
  
        <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
        <div>
            <label for="content">Ecrivez votre message :</label><br><br>
            <textarea name="content" id="content" cols="100" rows="10"></textarea>
        </div><br><br>
        
        <button type="submit" class="button">Envoyer</button>
    </form>
</div>
@endsection