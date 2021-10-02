<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateValidationRequest;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Product;
use App\Rules\Uppercase;

class CarController extends Controller
{
    // for non logged in user 
    // guest users can see index and show 
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Select * from cars

        // Fetch data from db using Eloquent Model
        $cars = Car::all();

        // Fetch all data which name is Ahmad
        // $cars = Car::where('name', '=', 'Ahmad')
        // ->get();


        // $cars = Car::chunk(2, function($cars) {
        //     foreach ($cars as $car) {
        //         print_r($car);
        //     }
        // });

        // firstOrFail)_
        // $cars = Car::where('name', '=', 'Ahmad')
        // ->firstOrFail();        

        // findOrFail() 
        //  $cars = Car::where('name', '=', 'Ahmad')->findOrFail();

        // all() method 
        // print_r(Car::where('name', '=', 'Ahmad')->count());
        // print_r(Car::all()->count());

        // sum() 
        // print_r(Car::sum('id'));
        // avg()
        // print_r(Car::avg('id'));    



        // dd($data);    die and dump data

        // pass data to the view
        return view('cars.index', [
            "cars" => $cars
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // this function is used to insert data to db
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // to store data to db
        // dd("OK");

        // before creating car check if data is valid or not
        // if it's valid, it will procces
        // it it's not valid, throw a validationExeption

        /*   validation 
       $uppercase = new Uppercase;
        $request->validate([
            // 'name' => 'required|unique:cars',
            'name' => $uppercase, ["required"],
            'founded' => 'required|min:1990|max:2021|integer',
            'description' => 'required'
        ]);
        */

        // validation in request
        // $request->validated();

        // image upload 
        // methoda that we use in request 
        //guessExtension()
        //getMimeType()
        //store()
        //asStore()
        //storePublilcy()
        //move()
        //getClientOriginalName()
        //getClientMimeType()
        //guessClientExtension()
        //getSize()
        //getError()     0 --> no problem   1 --> problem
        // isValid() 

        // $test = $request->file('image')->guessExtension();
        // dd($test);
        
        $request->validate([
            // 'name' => 'required|unique:cars',
            'name' => "required",
            'founded' => 'required|min:1990|max:2021|integer',
            'description' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:2048'
        ]);
        $newImageName = time() . "-" . $request->name . $request->image->extension();
        // dd($newImageName);
        $request->image->move(public_path('images'), $newImageName);

/*  

        $car = new Car;
        $car->name = $request->name;
        $car->founded = $request->founded;
        $car->description = $request->description;
        $car->save();
*/
        // second and recommanded way 
        $car = Car::create([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image' => $newImageName, 
            'user_id' => auth()->user()->id
        ]);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $car = Car::find($id);
        // dd($car->engines);    when we used has many through relationship inside the Car.php
        //dd($car->productionDate);  hasOneThrough relationship
        //dd($car->products);  // many to many relationship 

        // inverse many to many 
        // print all products related to this car
        // $products = Product::find($id);
        // print_r($products);


        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // to display edit page
        // dd($id);
        $car = Car::find($id)->first();
        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateValidationRequest $request, $id)
    {
        //validation when using request 
        $request->validated();


        $car = Car::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description')
            ]);

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $car = Car::find($id)->first();
        $car->delete();

        return redirect('/cars');
    }
}
