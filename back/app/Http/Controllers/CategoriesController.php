<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Resources\Categories as CategoriesResource;


class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        if ($request->page) {
            $categories = Categories::paginate(10);
        } else {
            $categories = Categories::get();
        }
        return CategoriesResource::collection($categories);
    }

    public function show($id)
    {
        $categories = Categories::findOrFail($id);
        return new CategoriesResource($categories);
    }

    public function store(Request $request)
    {
        $categories = new Categories;
        $categories->name = $request->input('name');
        $categories->description = $request->input('description');

        if ($categories->save()) {
            return new CategoriesResource($categories);
        }
    }

    public function update(Request $request)
    {
        $categories = Categories::findOrFail($request->id);
        $categories->name = $request->input('name');
        $categories->description = $request->input('description');

        if ($categories->save()) {
            return new CategoriesResource($categories);
        }
    }

    public function destroy($id)
    {
        $categories = Categories::findOrFail($id);
        if ($categories->delete()) {
            return new CategoriesResource($categories);
        }
    }
}
