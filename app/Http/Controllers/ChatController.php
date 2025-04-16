<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getMessages($customerId)
    {
        $messages = Chat::where(function ($query) use ($customerId) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $customerId);
        })->orWhere(function ($query) use ($customerId) {
            $query->where('sender_id', $customerId)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        $customer = User::find($customerId);

        return response()->json([
            'messages' => $messages,
            'customer' => $customer
        ]);
    }
    public function sendMessage(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $chat = Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->customer_id,
            'message' => $request->message,
        ]);

        return response()->json(['success' => true, 'message' => 'Pesan berhasil dikirim!', 'chat' => $chat]);
    }
    public function getUserMessages()
    {
        $userId = Auth::id();
        $admin = User::where('role', 'admin')->first(); // Ambil admin pertama

        if (!$admin) {
            return response()->json(['error' => 'Admin tidak ditemukan'], 404);
        }

        $messages = Chat::whereIn('sender_id', [$userId, $admin->id])
            ->whereIn('receiver_id', [$userId, $admin->id])
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'messages' => $messages,
            'admin' => $admin
        ]);
    }
    public function sendUserMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:1|max:1000',
        ]);

        $userId = Auth::id();
        $admin = User::where('role', 'admin')->first(); // Cari admin

        if (!$admin) {
            return response()->json(['error' => 'Admin tidak ditemukan'], 404);
        }

        $chat = Chat::create([
            'sender_id' => $userId,
            'receiver_id' => $admin->id,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim!',
            'chat' => $chat
        ]);
    }
}
