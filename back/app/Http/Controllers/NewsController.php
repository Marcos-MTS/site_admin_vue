<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Resources\News as NewsResource;
 

class NewsController extends Controller
{
    
    public function index()
    {

        $news = News::paginate(5);
        return NewsResource::collection($news);
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
            return new NewsResource($news);
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