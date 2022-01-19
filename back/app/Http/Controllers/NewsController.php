<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    
    
    
    public function index()
    {

        echo "TESTE";
      //  $artigos = Artigo::paginate(15);
      //  return ArtigoResource::collection($artigos);
    }

    public function show($id)
    {
      //  $artigo = Artigo::findOrFail($id);
       // return new ArtigoResource($artigo);
    }

    public function store(Request $request)
    {
        $news = new News;
        $news->title = $request->input('title');
        $news->author = $request->input('author');

        if ($news->save()) {
          //  return new ArtigoResource($artigo);
        }
    }

    public function update(Request $request)
    {
      //  $artigo = Artigo::findOrFail($request->id);
       // $artigo->titulo = $request->input('titulo');
       // $artigo->conteudo = $request->input('conteudo');

       // if ($artigo->save()) {
       //     return new ArtigoResource($artigo);
       // }
    }

    public function destroy($id)
    {
       // $artigo = Artigo::findOrFail($id);
       // if ($artigo->delete()) {
       //     return new ArtigoResource($artigo);
       // }
    }

}