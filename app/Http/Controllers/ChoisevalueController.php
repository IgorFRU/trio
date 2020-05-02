<?php

namespace App\Http\Controllers;

use Choisevalue;
use Illuminate\Http\Request;
use App\Http\Services\WorkWithImage;

class ChoisevalueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function store(Request $request) {
        // return response()->json(['data' => $request->all()], 200);
        return $request->all();

        if($request->choises_image) {
            $path = public_path().'/imgs/choise/images/';
            if (!file_exists($path)) {
                mkdir($path, 0777);
            }
            $file = $request->choises_image;
            $img = new WorkWithImage($file, $path);
            $img->saveImage();
        }
        if($request->choises_thumbnail) {
            $path = public_path().'/imgs/choise/thumbnails/';
            if (!file_exists($path)) {
                mkdir($path, 0777);
            }
            $file = $request->choises_thumbnail;
            $thumbnail = new WorkWithImage($file, $path);
            $thumbnail->saveImage();
        }

        
    }
}
