<?php

namespace App\Http\Controllers\Api;

use App\Models\Attribute;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use function App\Http\Controllers\storeImage;

class AttributeApiController extends Controller
{
    public function getAttributes(Request $request){
        $attributes = Attribute::all();
    
    if ($attributes) {
        return Response::json(
            $attributes,
            200
        );
    } else {
        return Response::json(
            ['error' => 'no attributes found'],
            201
        );
    }
    }

    public function getImagesFormAttribute(Request $request){
        $images = Image::where('attribute_id' , '=' , $request->attribute_id)->get();
    
    if ($images) {
        return Response::json(
            $images,
            200
        );
    } else {
        return Response::json(
            ['error' => 'no images found'],
            201
        );
    }
    }

    public function uploadImageToAttribute (Request $request) {

        $image = new Image();

        if ($file = $request->file('image')) {
            
            storeImage($file , $request->id , $image);

        } else {

            return Response::json(
                ['error' => 'please choose image first'],
                201
            );
        }

        $image->attribute_id = $request->id;
        $image->save();

        if ($image) {
            return Response::json(
                $image,
                200
            );
        } else {
            return Response::json(
                ['error' => 'no images found'],
                201
            );
        }
    }

    
}
