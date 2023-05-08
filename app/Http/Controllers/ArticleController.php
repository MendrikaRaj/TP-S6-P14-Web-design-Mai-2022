<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //

    public function posterArticle(Request $request)
    {
        # code...
        $request->validate([
            'Titre' => 'required',
            'Auteur' => 'required',
            'resume' => 'required',
            'Image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'Contenu' => 'required'
        ]);

        $file = $request->file('Image');
        $extension = $file->getClientOriginalExtension();
        $filename =time().'.'.$extension;
        $file->move('public/',$filename);

        $article = new Article();
        $article->Titre = $request->input('Titre');
        $article->Auteur = $request->input('Auteur');
        $article->resume = $request->input('resume');
        $article->image = $filename;
        $article->contenu = $request->input('Contenu');
        $res = $article->save();

        if ($res) {
            return back()->with('success', 'Votre article a été poster');
        } else {
            return back()->with('fail', 'Quelque chose c`est mal passé');
        }
    }
    public function infoDetail($id){
        # code...
        return view('detailinfo',['detail'=>Article::where('id','=', $id)->get()]);
    }
}
