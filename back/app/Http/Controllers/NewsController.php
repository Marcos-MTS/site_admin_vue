<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Resources\News as NewsResource;


class NewsController extends Controller
{

    public function index(Request $request)
    {
        $news = News::where('title', 'LIKE', "%{$request->search}%")->paginate(10) ;
        return NewsResource::collection($news);
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return new NewsResource($news);
    }

    public function store(Request $request)
    {

        $file = $request->file('image');
   
        //Display File Name
      //  echo 'File Name: '.$file->getClientOriginalName();
       // echo '<br>';

        $news = new News;
        $news->image = $file->getClientOriginalName();
        $news->title = $request->input('title');
        $news->author = $request->input('author');
        $news->categorie_id = $request->input('categorie_id');

        if ($news->save()) {
            return new NewsResource($news);
        }
    }

    public function update(Request $request)
    {
        $news = News::findOrFail($request->id);
        $news->title = $request->input('title');
        $news->author = $request->input('author');
        $news->categorie_id = $request->input('categorie_id');

        if ($news->save()) {
            return new NewsResource($news);
        }
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->delete()) {
            return new NewsResource($news);
        }
    }
}
