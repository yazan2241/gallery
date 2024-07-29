<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
    
    public function index(Request $request)
    {
        $attributes = $this->search($request);
        return view('index' , compact('attributes'));
    
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
            'title' => 'required|min:3',
        ]);

        $attribute = new Attribute();
        $attribute->title = $request->title;
        $attribute->type = ($request->type == "on") ? 2 : 1;
        $attribute->save();
        return Redirect::to('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }

    public function search(Request $request){
        if($request->has('search')){

            $search = $request->search;
            $attributes = Attribute::where('title' , 'LIKE' , '%'.$search.'%')->get();
        } else {
            $attributes = Attribute::all();
        }
        return $attributes;
    }
    
}
