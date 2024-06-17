<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $messages = Message::where('receiver_id', $user->id)
        ->with('sender')
        ->orderByDesc('created_at')
        ->get();

        $unreadCount = $messages->where('is_read', false)->count();

        return view('messages.index', ['messages'=> $messages,
                                        'unreadCount' => $unreadCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userId)
    {
       
        return view('messages.create', ['receiver_id' => $userId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'content' => $data['content'],
            'receiver_id' => $data['receiver_id'],
            'sender_id' => Auth::id(),
        ]);

        return redirect()->route('users.show', ['user' => Auth::id()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Message::find($id);

        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return view('messages.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = Message::find($id);

        $message->delete();
        return redirect()->route('messages.index');
    }
}
