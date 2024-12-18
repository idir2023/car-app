<?php

namespace App\Http\Controllers;

use App\Models\Marke;
use App\Models\ModelCar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ModelCarController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $modelCars = ModelCar::query();
        $markes = Marke::all();

        if (request()->ajax()) {
            return Datatables::of($modelCars)
            ->addColumn('action', function($modelCar) {
                return '<button class="btn btn-outline-primary btn-sm editBtn" data-id="'.$modelCar->id.'">Edit</button>
                        <button class="btn btn-outline-danger btn-sm deleteBtn" data-id="'.$modelCar->id.'">Delete</button>';
            })
            ->addColumn('marke', function($modelCar) {
                return $modelCar->marke->name;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.model_cars.index', compact('markes'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.model_cars.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255', // You can adjust validation rules as needed
            'marke_id' => 'required|exists:markes,id', // Ensure the marke_id exists in the markes table
        ]);

        // Create the ModelCar instance and save it
        $modelCar = new ModelCar;
        $modelCar->name = $request->name;
        $modelCar->marke_id = $request->marke_id;
        $modelCar->save();

        // Return a JSON response with a success message
        return response()->json([
            'message' => 'Model Car created successfully.',
            'modelCar' => $modelCar // Optionally, include the saved model data if needed
        ], 201); // HTTP status 201 for created resource
    }


    // Show the form for editing the specified resource
    public function edit($id)
    {
        $modelCar = ModelCar::findOrFail($id);
        return response()->json($modelCar);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $modelCar = ModelCar::findOrFail($id);
        $modelCar->update($request->all());

        return response()->json(['message' => 'Model Car updated successfully.']);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $modelCar = ModelCar::findOrFail($id);
        $modelCar->delete();

        return response()->json(['message' => 'Model Car deleted successfully.']);
    }
}
