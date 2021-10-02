@extends('layout.app')

@section('title')
    Details
@endsection

@section('content')
<div class="m-auto w-4/5 py-24">
    <img src="{{ asset('images/'. $car->image) }}" 
    alt="Car Image" class="w-10/12 m-8 shadow-xl"> <br>
    <div class="text-center">
        <h2 class="text-5xl uppercase bold">
            {{ $car->name }}
        </h2>
    </div>


    <div class="py-10 text-center">        
        <div class="m-auto">
            <span class="uppercase text-blue-500 font-bold text-xs italic">
                {{ $car->founded }}
           </span> 

           <p class="text-gray-700 text-lg py-6">
               {{ $car->description }}
           </p>

           {{-- Has Many through relationship --}}
            <table class="table-auto ">
                <tr class="bg-blue-100">
                    <th class="w-1/2 border-4 border-gray-500">
                        Model 
                    </th>
                    <th class="w-1/2 border-4 border-gray-500">
                        Engines
                    </th>
                    <th class="w-1/2 border-4 border-gray-500">
                           Date 
                    </th>    
                </tr>
                @forelse ($car->carModels as $model)
                    <tr>
                        <td class="borderd-4 border-gray-500">
                            {{ $model['model'] }}
                        </td>

                        <td class="border-4 border-gray-500">

                            @foreach ($car->engines as $engine)
                                @if ($model->id == $engine->car_model_id)
                                    {{ $engine->engine_name }}
                                @endif
                            @endforeach                                                                                        
                        </td>
                        <td class="border-4 border-gray-500">
                            {{-- has one through relationship  --}}
                            {{  date("Y-m-d", strtotime($car->productionDate->created_at))  }}
                        </td>    
                    </tr>
                @empty
                    <td>No Model found!</td>
                @endforelse
           </table>
            
           @forelse ($car->products as $product)
           Product Types: 
                {{ $product->name }}
           @empty
               <p>
                   No Proudct
               </p>
           @endforelse

           <hr class="mt-4 mb-8" /> 

        </div>
         

    </div>
</div>
@endsection