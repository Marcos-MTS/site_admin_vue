<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Str;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $User = User::where('name', 'LIKE', "%{$request->search}%")->paginate(10);
        return UserResource::collection($User);
    }

    public function show($id)
    {
        $User = User::findOrFail($id);
        return new UserResource($User);
    }

    public function store(UserStoreRequest $request)
    {
        if ($request->file()) {

            $file = $request->file('image');

            $fileName = time() . '-' . Str::slug($request->input('name')) . '.' . $file->getClientOriginalExtension();

            //upload da imagem
            $destinationPath = 'uploads/users';
            $file->move($destinationPath,  $fileName);

            $user = new User;
            $user->image = $fileName;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            //  $user->author = $request->input('author');
            $user->users_levels_id = $request->input('users_levels_id');

            if ($user->save()) {
                return new UserResource($user);
            }
        }
    }


    public function update(UserUpdateRequest $request)
    {
        $user = User::findOrFail($request->id);

        $oldImage = $user->image;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->users_levels_id = $request->input('users_levels_id');

        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        //   $user->author = $request->input('author');
        //  $user->categorie_id = $request->input('categorie_id');

        if ($request->file()) {

            $file = $request->file('new_image');

            $fileName = time() . '-' . Str::slug($request->input('name')) . '.' . $file->getClientOriginalExtension();

            $destinationPath = 'uploads/users';
            $file->move($destinationPath,  $fileName);

            //excluimos a antiga imagem
            $oldFilePath = $destinationPath . "/" . $oldImage;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            $user->image = $fileName;
        }

        if ($user->save()) {
            return new UserResource($user);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $image = $user->image;

        if ($user->delete()) {

            $destinationPath = 'uploads/users';

            //excluimos a imagem
            $filePath = $destinationPath . "/" . $image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return new UserResource($user);
        }
    }
}
