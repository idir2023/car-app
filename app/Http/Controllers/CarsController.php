<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\Marke;
use App\Models\ModelCar;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all cars with relationships (eager loading)
        $cars = Car::with(['marke', 'modelCar'])->orderBy('created_at', 'desc')->get();

        // Return the index view and pass the cars data
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the create view
        $markes = Marke::all();
        $models  = ModelCar::all();

        return view('admin.cars.create', compact('markes', 'models'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'marke_id' => 'required|exists:markes,id',
            'model_id' => 'required|exists:model_cars,id',
            'year' => 'required|integer',
            'engine_type' => 'required|string',
            'color' => 'required|string',
            'seats' => 'nullable|integer',
            'doors' => 'nullable|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:available,sold,reserved',
            // 'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);

       $car = Car::create($validatedData);

        if($request->file('image')){
            foreach($request->file('image') as $image){
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $image->store('cars', 'public'),
                ]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Car created successfully!');
    }

    public function getModels($id)
    {
        $models = ModelCar::where('marke_id', $id)->get();
        return response()->json($models);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
           // Return the edit view
           $car = Car::findOrFail($id);
           $markes = Marke::all();
           $models  = ModelCar::all();

           return view('admin.cars.edit', compact('car', 'markes', 'models'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'marke_id' => 'required|exists:markes,id',
            'model_id' => 'required|exists:model_cars,id',
            'year' => 'required|integer',
            'engine_type' => 'required|string',
            'color' => 'required|string',
            'seats' => 'nullable|integer',
            'doors' => 'nullable|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:available,sold,reserved',
            // 'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);

        $car = Car::findOrFail($id);
        $car->update($validatedData);

        if($request->file('image')){
            foreach($request->file('image') as $image){
                CarImage::create([
                    'car_id' => Car::latest()->first()->id,
                    'image_path' => $image->store('cars', 'public'),
                ]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Car updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Car::findOrFail($id)->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully!');
    }
}
