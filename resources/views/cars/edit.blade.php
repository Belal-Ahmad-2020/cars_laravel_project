@extends('layout.app')

@section('title')
    Create Car
@endsection

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="uppercase text-5xl bold">
                Update  Car
            </h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <form action="/cars/{{ $car->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="block">
                <input type="text" class="block shadow-5xl mb-10 p-2 w-88 italic "
                placeholder="Brand Name ..."  name="name" value="{{ $car->name }}">

                <input type="text" class="block shadow-5xl mb-10 p-2 w-88 italic "
                placeholder="Founded ..."  name="founded" value="{{ $car->founded }}">

                <input type="text" class="block shadow-5xl mb-10 p-2 w-88 italic "
                placeholder="Description.."  name="description" value="{{ $car->description }}">

            <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                Update
            </button>    
            </div>
        </form>
    </div>
@endsection