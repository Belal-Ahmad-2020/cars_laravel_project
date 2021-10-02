@extends('layout.app')

@section('title')
    Create Car
@endsection

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="uppercase text-5xl bold">
                Create Car
            </h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <form action="/cars" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="block">
                <input type="file" class="block shadow-5xl mb-10 p-2 w-88 italic "
                  name="image">
                <input type="text" class="block shadow-5xl mb-10 p-2 w-88 italic placeholder-gray-400"
                placeholder="Brand Name ..."  name="name">

                <input type="text" class="block shadow-5xl mb-10 p-2 w-88 italic "
                placeholder="Founded ..."  name="founded">

                <input type="text" class="block shadow-5xl mb-10 p-2 w-88 italic "
                placeholder="Description.."  name="description">

            <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                Submit
            </button>    
            </div>
        </form>
    </div>

    @if ($errors->any())
        <div class="w-4/8 m-auto text-center">
             @foreach ($errors->all() as $error)
                <li class="text-red-500 list-none">
                    {{ $error }}
                </li>                              
             @endforeach   
        </div>  
    @endif
@endsection