<?php

namespace App\Http\Controllers;


use App\Models\Attribute;
use App\Models\Image as ModelsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Colors\Rgb\Channels\Red;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $images = ModelsImage::where('attribute_id' , '=' , $id)->get();
        return view('gallery', ['images' => $images , 'id' => $id ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required'],
        ]);

        $image = new ModelsImage();

        if ($file = $request->file('image')) {
            
            storeImage($file , $request->id , $image);

        } else {

            return Redirect::to('/gallery/' . $request->id);
        }

        $image->attribute_id = $request->id;
        $image->save();
        return Redirect::to('/gallery/' . $request->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelsImage $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $image = ModelsImage::find($request->image_id);

        if ($file = $request->file('image')) {
            storeImage($file , $request->id , $image);
        } else {

            return Redirect::to('/gallery/' . $request->id);
        }

        $image->update();
        return Redirect::to('/gallery/' . $request->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsImage $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        ModelsImage::destroy($request->image_id);
        return Redirect::to('/gallery/' . $request->id);
    }
}

function convertImageToGrayScale($name , $grayName , $ext)
{
    // return $ext;
    switch($ext) {
        case 'png' :
            $im = imagecreatefrompng(public_path('images') . '/' . $name);  
            break;
        default :
            $im = imagecreatefromjpeg(public_path('images') . '/' . $name);
    }

    $imgw = imagesx($im);
    $imgh = imagesy($im);

    for ($i = 0; $i < $imgw; $i++) {
        for ($j = 0; $j < $imgh; $j++) {

            // get the rgb value for current pixel

            $rgb = ImageColorAt($im, $i, $j);

            // extract each value for r, g, b

            $rr = ($rgb >> 16) & 0xFF;
            $gg = ($rgb >> 8) & 0xFF;
            $bb = $rgb & 0xFF;

            // get the Value from the RGB value

            $g = round(($rr + $gg + $bb) / 3);

            // grayscale values have r=g=b=g

            $val = imagecolorallocate($im, $g, $g, $g);

            // set the gray value

            imagesetpixel($im, $i, $j, $val);
        }
    }

    imagejpeg($im , public_path('images') . '/' . $grayName);
    imagedestroy($im);
}

function transliterate($textcyr = null) {
    $cyr = array(
    'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
    'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');
    $lat = array(
    'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q',
    'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q');
    return str_replace($cyr, $lat, $textcyr);
}

function storeImage($file , $id , $image) {
    $attribute = Attribute::where('id', '=', $id)->first();
            //foreach ($files as $file) {

            $imageName = time() . $file->getClientOriginalName();
            $imageName = strtolower(transliterate($imageName));
            $file->move(public_path('images'), $imageName);
            $image->image = $imageName;

            if ($attribute->type == 2) {
                $greyName = time() . "_grey_" . $file->getClientOriginalName() ;
                $greyName = strtolower(transliterate($greyName));
                convertImageToGrayScale($imageName , $greyName , $file->getClientOriginalExtension());
                $image->image_gray = $greyName;
            }
}
