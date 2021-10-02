@extends('layout.app')

@section('title')
    Cars
@endsection

@section('content')
<div class="m-auto w-4/5 py-24">

    <div class="text-center">
        <h2 class="text-5xl uppercase bold">
            Cars
        </h2>
    </div>

    {{-- if user is logged in can see create car btn --}}
    @if (Auth::user())
    <div class="pt-10">
        <a href="cars/create"
        class="border-b-2  pb-2 border-dotted italic text-gray-500">
            Add new Car &rarr;
        </a>
    </div>        
    @else
    <p class="py-12 italic">
        please loggend in first to add a new car
    </p>
    @endif


    <div class="w-5/6 py-10">
        @foreach ($cars as $car)
        <div class="m-auto">
            @if (isset(Auth::user()->id) && Auth::user()->id == $car->user_id)
                <div class="float-right">
                    <a href="cars/{{ $car->id }}/edit"
                        class="border-b-2  pb-2 border-dotted italic text-green-500">
                        Edit &rarr;
                    </a>

                    <form action="/cars/{{ $car->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                        class="border-b-2  pb-2 border-dotted italic text-red-500">
                            Delete &rarr;
                        </button>
                    </form>
                </div>
            @endif

            <span class="uppercase text-blue-500 font-bold text-xs italic">
                {{ $car->founded }}
           </span> 
           <h3 class="text-gray-700 text-5xl hover:text-gray-700 ">
               <a href="/cars/{{ $car->id }}">
                {{ $car->name }}
               </a>
           </h3>

           <p class="text-gray-700 text-lg py-6">
               {{ $car->description }}
           </p>

           <hr class="mt-4 mb-8" /> 

        </div>
        @endforeach    

    </div>
</div>
@endsection