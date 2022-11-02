<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UsersLevel;
use Illuminate\Http\Request;
use App\Http\Resources\UsersLevel as UsersLevelResource;
use App\Http\Requests\UsersLevelRequest;


class UsersLevelController extends Controller
{

    public function index(Request $request)
    {
        if ($request->page) {
            $usersLevel = UsersLevel::paginate(10);
        } else {
            $usersLevel = UsersLevel::get();
        }
        return UsersLevelResource::collection($usersLevel);
    }

    public function show($id)
    {
        $usersLevel = UsersLevel::findOrFail($id);
        return new UsersLevelResource($usersLevel);
    }

    public function store(UsersLevelRequest $request)
    {
        $usersLevel = new UsersLevel;
        $usersLevel->name = $request->input('name');

        if ($usersLevel->save()) {
            return new UsersLevelResource($usersLevel);
        }
    }

    public function update(UsersLevelRequest $request)
    {
        $usersLevel = UsersLevel::findOrFail($request->id);
        $usersLevel->name = $request->input('name');

        if ($usersLevel->save()) {
            return new UsersLevelResource($usersLevel);
        }
    }

    public function destroy($id)
    {
        $usersLevel = UsersLevel::findOrFail($id);
        if ($usersLevel->delete()) {
            return new UsersLevelResource($usersLevel);
        }
    }
}
