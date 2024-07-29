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

    
    

    
}
