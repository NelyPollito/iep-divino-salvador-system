<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create()
    {
        $authUser = Auth::user();

        if (!$authUser) {
            return redirect()
                ->route('login')
                ->with('error', 'Debe iniciar sesión para acceder a la mensajería.');
        }

        $users = User::where('iduser', '!=', $authUser->iduser)
            ->where('status', 1)
            ->get();

        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $authUser = Auth::user();

        if (!$authUser) {
            return redirect()
                ->route('login')
                ->with('error', 'Debe iniciar sesión para enviar mensajes.');
        }

        $request->validate([
            'receiver_id' => 'required|integer|exists:users,iduser|not_in:' . $authUser->iduser,
            'type' => 'required|string|max:50',
            'subject' => 'required|string|max:150',
            'body' => 'required|string',
        ]);

        Message::create([
            'sender_id' => $authUser->iduser,
            'receiver_id' => $request->receiver_id,
            'type' => $request->type,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return redirect()
            ->route('messages.create')
            ->with('success', 'Mensaje enviado correctamente.');
    }

    public function inbox()
    {
        $authUser = Auth::user();

        if (!$authUser) {
            return redirect()
                ->route('login')
                ->with('error', 'Debe iniciar sesión para ver la bandeja de entrada.');
        }

        $messages = Message::with('sender')
            ->where('receiver_id', $authUser->iduser)
            ->latest()
            ->get();

        return view('messages.inbox', compact('messages'));
    }

    public function sent()
    {
        $authUser = Auth::user();

        if (!$authUser) {
            return redirect()
                ->route('login')
                ->with('error', 'Debe iniciar sesión para ver los mensajes enviados.');
        }

        $messages = Message::with('receiver')
            ->where('sender_id', $authUser->iduser)
            ->latest()
            ->get();

        return view('messages.sent', compact('messages'));
    }

    public function show(Message $message)
    {
        $authUser = Auth::user();

        if (!$authUser) {
            return redirect()
                ->route('login')
                ->with('error', 'Debe iniciar sesión para ver el mensaje.');
        }

        $isSender = $message->sender_id == $authUser->iduser;
        $isReceiver = $message->receiver_id == $authUser->iduser;

        if (!$isSender && !$isReceiver) {
            abort(403, 'No tiene permiso para ver este mensaje.');
        }

        if ($isReceiver && !$message->read_at) {
            $message->update([
                'read_at' => now(),
            ]);
        }

        $message->load(['sender', 'receiver']);

        return view('messages.show', compact('message'));
    }
}