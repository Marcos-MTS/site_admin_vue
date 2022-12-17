<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
/* use App\Http\Resources\Gallery as GalleryResource; */
use Illuminate\Support\Str;
/* use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest; */

class GalleryController extends Controller
{

  /*   public function index(Request $request)
    {
        $gallery = Gallery::where('title', 'LIKE', "%{$request->search}%")->paginate(10);
        return GalleryResource::collection($gallery);
    } */

   /*  public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return new GalleryResource($gallery);
    }

    public function store(GalleryStoreRequest $request)
    {
        if ($request->file()) {

            $file = $request->file('image');

            $fileName = time() . '-' . Str::slug($request->input('title')) . '.' . $file->getClientOriginalExtension();

            //upload da imagem
            $destinationPath = 'uploads/gallery';
            $file->move($destinationPath,  $fileName);

            $gallery = new Gallery;
            $gallery->image = $fileName;
            $gallery->title = $request->input('title');
            $gallery->author = $request->input('author');
            $gallery->categorie_id = $request->input('categorie_id');

            if ($gallery->save()) {
                return new GalleryResource($gallery);
            }
        }
    } */


    public function update(Request $request)
    {
echo "testee";
print_r($request);

die;

        $gallery = Gallery::findOrFail($request->id);

        $oldImage = $gallery->image;

        $gallery->title = $request->input('title');
        $gallery->author = $request->input('author');
        $gallery->categorie_id = $request->input('categorie_id');

        if ($request->file()) {

            $file = $request->file('new_image');

            $fileName = time() . '-' . Str::slug($request->input('title')) . '.' . $file->getClientOriginalExtension();

            $destinationPath = 'uploads/gallery';
            $file->move($destinationPath,  $fileName);

            //excluimos a antiga imagem
            $oldFilePath = $destinationPath . "/" . $oldImage;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            $gallery->image = $fileName;
        }

        if ($gallery->save()) {
          //  return new GalleryResource($gallery);
        }
    }

    /* public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $image = $gallery->image;

        if ($gallery->delete()) {

            $destinationPath = 'uploads/gallery';
          
            //excluimos a imagem
            $filePath = $destinationPath . "/" . $image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return new GalleryResource($gallery);
        }
    } */
}
