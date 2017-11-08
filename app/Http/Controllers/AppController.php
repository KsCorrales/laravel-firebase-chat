<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Chat;
use Auth;

class AppController extends Controller
{
    public function index()
    {
        // Get all users except current logged in
        $users = User::where('id', '!=', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(8);
        return view('app.inicio', compact('users'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('entrar');
    }

    public function usersChat($userName)
    {
        $receptorUser = User::where('username', '=', $userName)->first();
        if($receptorUser == null) {
            return view('app.nousernamefinded', compact('userName'));
        }else {
            $users = User::where('id', '!=', Auth::user()->id)->take(10)->get();
            $chat = $this->hasChatWith($receptorUser->id); 
            return view('app.chat', compact('receptorUser', 'chat', 'users'));
        }
    }

    public function hasChatWith($userId)
    {
        $chat = Chat::where('user_id1', Auth::user()->id)
            ->where('user_id2', $userId)
            ->orWhere('user_id1', $userId)
            ->where('user_id2', Auth::user()->id)
            ->get();
        if(!$chat->isEmpty()){
            return $chat->first();
        }else{
            return $this->createChat(Auth::user()->id, $userId);;
        }
    }

    public function createChat($userId1, $userId2)
    {
        $chat = Chat::create([
            'user_id1' => $userId1,
            'user_id2' => $userId2
        ]);
        return $chat;
    }
}
