<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Imports\MarkesImport; // Import the MarkesImport class

class ExcelImportController extends Controller
{
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file using the MarkesImport class
        Excel::import(new MarkesImport, $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
