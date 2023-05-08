<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function registration()
    {
        return view('registration');
    }

    public function login()
    {
        return view('login');
    }

    public function regAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        if ($res) {
            return back()->with('success', 'You Have Registered successfully');
        }else{
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function logAdmin(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                # code...
                $request->session()->put('loginId', $user->id);
                return redirect('poste');
            }
            else {
                return back()->with('fail', 'Mot de passe incorrect');
            }
        }else{
            return back()->with('fail', 'Cette Email n`est pas encore enregistrer');
        }
    }

    public function accueil(){
        return view('liste',['listeArticle'=>Article::all()]);
        // $data = array();
        // if (Session::has('loginId')){
        //     # code...
        //     $data = User::where('id', '=', Session::get('loginId'))->first();
        //     return view('liste', compact('data'),['listeArticle'=>Article::all()]);
        // }
        // return back();
    }

    public function liste(){
        $data = array();
        if (Session::has('loginId')){
            # code...
            $data = User::where('id', '=', Session::get('loginId'))->first();
            return view('liste', compact('data'),['listeArticle'=>Article::all()]);
        }
        return back();
    }

    public function poste(){
        $data = array();
        if (Session::has('loginId')){
            # code...
            $data = User::where('id', '=', Session::get('loginId'))->first();
            return view('poste', compact('data'));
        }
        return back();
    }

    public function logout()
    {
        # code...
        if (Session::has('loginId')){
            # code...
            Session::pull('loginId');
            return redirect('/');
        }
    }
}
