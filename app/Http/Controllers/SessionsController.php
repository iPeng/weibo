<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }
    public function store(Request $request)
    {
        $credentials = $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required'
        ]);
        if(Auth::attempt($credentials)){
            session()->flash('success','Welcome back~！');
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            session()->flash('danger','Sorry,password or email wrong!');
            return redirect()->back()->withInput();
        }
        return;
    }
}
