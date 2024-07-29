@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-12">

    <div class="w-full mt-5 flex justify-between">

        <form method="post" action='{{ url("addAttribute") }}'>
            @csrf

            <div class="flex gap-2">

                <input type="text" name="title" placeholder="add title" class=" rounded-lg border border-gray-500" />
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="type" />
                    <p>Gray Images</p>
                </div>
                <button class="bg-green-500 text-white p-2 rounded-lg">Add New</button>
            </div>
        </form>

        <form method="get" action='{{ url("/") }}'>
        @csrf
            <div class="flex">
                
                <input type="text" name="search" placeholder="Search By title ..." class=" border-blue-500 border rounded-tl-lg rounded-bl-lg " />
                <button class="bg-blue-500 text-white rounded-tr-lg rounded-br-lg p-2" type="submit">Search</button>
            </div>
        </form>


    </div>

    <div class="w-full flex gap-3">
        @foreach ($attributes as $attribute)
        <a href="/gallery/{{ $attribute->id }}">
            <div class="bg-white border border-gray-300 rounded-lg p-4 w-32 h-32 flex items-center justify-center">
                {{$attribute->title}}
            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection