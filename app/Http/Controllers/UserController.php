<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Hash;
use Storage;
class UserController extends Controller
{
    //
    protected function store(Request $request){
        $this->validate($request, ['image' => 'required|image']);
        if($request->hasfile('image'))
         {
            $file = $request->file('image');
            $name=time().$file->getClientOriginalName();
            $filePath = 'images/' . $name;
            $path = Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($path);
            return response()->json($path);
         }
    }
}
