<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Resources\News as NewsResource;
use Illuminate\Support\Str;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;

class NewsController extends Controller
{

    public function index(Request $request)
    {
        $news = News::where('title', 'LIKE', "%{$request->search}%")->paginate(10);
        return NewsResource::collection($news);
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return new NewsResource($news);
    }

    public function store(NewsStoreRequest $request)
    {
        if ($request->file()) {

            $file = $request->file('image');

            $fileName = time() . '-' . Str::slug($request->input('title')) . '.' . $file->getClientOriginalExtension();

            //upload da imagem
            $destinationPath = 'uploads/news';
            $file->move($destinationPath,  $fileName);

            $news = new News;
            $news->image = $fileName;
            $news->title = $request->input('title');
            $news->author = $request->input('author');
            $news->categorie_id = $request->input('categorie_id');

            if ($news->save()) {
                return new NewsResource($news);
            }
        }
    }


    public function update(NewsUpdateRequest $request)
    {
        $news = News::findOrFail($request->id);

        $oldImage = $news->image;

        $news->title = $request->input('title');
        $news->author = $request->input('author');
        $news->categorie_id = $request->input('categorie_id');

        if ($request->file()) {

            $file = $request->file('new_image');

            $fileName = time() . '-' . Str::slug($request->input('title')) . '.' . $file->getClientOriginalExtension();

            $destinationPath = 'uploads/news';
            $file->move($destinationPath,  $fileName);

            //excluimos a antiga imagem
            $oldFilePath = $destinationPath . "/" . $oldImage;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            $news->image = $fileName;
        }

        if ($news->save()) {
            return new NewsResource($news);
        }
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $image = $news->image;

        if ($news->delete()) {

            $destinationPath = 'uploads/news';
          
            //excluimos a imagem
            $filePath = $destinationPath . "/" . $image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return new NewsResource($news);
        }
    }
}
