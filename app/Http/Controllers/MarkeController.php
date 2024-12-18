<?php

namespace App\Http\Controllers;

use App\Models\Marke;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MarkeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $markes = Marke::query();

        if (request()->ajax()) {
            return DataTables::of($markes)
                ->addColumn('action', function ($mark) {
                    return '
                         <div class="flex justify-centerbtn-group" role="group">
                             <button type="button" class="btn btn-outline-primary btn-sm editBtn" data-id="' . $mark->id . '" onclick="edit(' . $mark->id . ')">Edit</button>
                             <button type="button" class="btn btn-outline-danger btn-sm deleteBtn" data-id="' . $mark->id . '">Delete</button>
                         </div>
                     ';
                })
                ->make(true);
        }

        return view('admin.markes.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


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
    public function edit($id)
    {
        $marke = Marke::find($id);

        if ($marke) {
            return response()->json($marke);
        } else {
            return response()->json(['message' => 'Marke not found'], 404);
        }
    }


    public function store(Request $request)
    {
        $mark = new Marke;
        $mark->name = $request->name;
        $mark->save();

        return response()->json(['message' => 'Marke created successfully']);
    }

    public function update(Request $request, $id)
    {
        $mark = Marke::find($id);
        $mark->name = $request->name;
        $mark->save();

        return response()->json(['message' => 'Marke updated successfully']);
    }

    public function destroy($id)
    {
        $mark = Marke::find($id);
        $mark->delete();

        return response()->json(['message' => 'Marke deleted successfully']);
    }
}
