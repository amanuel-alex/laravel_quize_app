<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    // Method to render the references page
    public function showReferencesPage()
    {
        return view('products.references');  // Render the references Blade view
    }

    // Method to get references from the JSON file
    public function getReferences()
    {
        // Path to the references JSON file
        $filePath = storage_path('app/public/references.json');

        // Check if the file exists
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'No such references file'], 404);
        }

        // Get the content of the JSON file
        $jsonContent = file_get_contents($filePath);

        // Decode the JSON content into an array
        $references = json_decode($jsonContent, true);

        // Check if references were found
        if (empty($references)) {
            return response()->json(['error' => 'No references found in the JSON file!'], 404);
        }

        // Return the references as JSON
        return response()->json($references);
    }
}
