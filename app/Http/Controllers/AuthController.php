<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class AuthController extends Controller
{
    public function login(){
        return view('admin.index');

    }
    public function ProcessLogin(Request $request)
    {
        try {
            $user = User::query()
                ->where('email',$request->get('email'))
                ->where('password',$request->get('password'))
                ->findOrFail();
            session()->put('id',$user->id);
            session()->put('name',$user->name);
            session()->put('usertype',$user->usertype);
//            session()->put('level',$user->level);
         return redirect()->route('admin.index');
        } catch (Throwable $e) {
      return redirect()->route('login');
        }



    }
}
