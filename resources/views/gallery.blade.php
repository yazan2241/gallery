@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-12 mt-5">

    <form method="post" enctype="multipart/form-data" action='{{ url("addImage") }}' class="w-full flex justify-between items-center">
        @csrf
        <label for="image" class="border border-gray-500 bg-white rounded-lg p-3">
            <img id="output" src="{{ asset('images/template.png') }}" alt="" width="150px" />
        </label>
        <div>
            <button class="text-white bg-green-500 p-2 rounded-lg">Add New Image</button>
        </div>
        <input id="image" type="file" class="hidden" name="image" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />

    </form>

    <hr class="mt-3 mb-3" />
    <div>
        @foreach($images as $image)
        <div class="flex justify-between">
            <label for="updateImage" >
                <img id="updatedImage" src="{{ asset('images/').'/'. $image->image }}" alt="" width="200px" />
            </label>
            @if($image->image_gray != null)
            <img src="{{ asset('images/').'/'. $image->image_gray }}" alt="" width="200px" />
            @endif
            <div class="flex gap-4 h-full items-center justify-center">
                <form method="post" action='{{ url("editImage") }}' enctype="multipart/form-data">
                    @csrf
                    <input id="updateImage" value="{{ asset('images/').'/'. $image->image }}" type="file" class="hidden" name="image" accept="image/*" onchange="document.getElementById('updatedImage').src = window.URL.createObjectURL(this.files[0])" />
                    <input type="hidden" name="id" value="{{$id}}" />
                    <input type="hidden" name="image_id" value="{{$image->id}}" />
                    <button class="bg-green-500 text-white p-3 rounded-lg">Edit</button>
                </form>
                <form method="post" action='{{ url("deleteImage") }}'>
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}" />
                    <input type="hidden" name="image_id" value="{{$image->id}}" />
                    <button class="bg-red-500 text-white p-3 rounded-lg">Delete</button>
                </form>
            </div>
        </div>
        <hr class="mt-3 mb-3" />
        @endforeach
    </div>

</div>

@endsection('content')