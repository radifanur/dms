<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::get();
        $aktivasi = User::where('verified', 0)->get();
        $acc = Hash::make('accept');
        $not = Hash::make('ignore');


        return view('users.index', [
            'user' => $user,
            'aktivasi' => $aktivasi,
            'acc' => $acc,
            'not' => $not
        ]);
    }

    public function aktivasi($id, $aktivasi)
    {
        $data = User::find($id);
        if (Hash::check('accept', $aktivasi)) {
            $data->verified = 1;
            $data->save();
        } else {
            $data->delete();
        }
        return redirect()->route('users');
    }

    
}
