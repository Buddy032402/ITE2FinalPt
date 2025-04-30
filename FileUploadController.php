<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function process(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp', $filename, 'public');
            
            return response()->json([
                'serverId' => $filename
            ]);
        }
        
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function revert(Request $request)
    {
        $filename = $request->getContent();
        Storage::disk('public')->delete('temp/' . $filename);
        
        return response()->noContent();
    }

    public function load(Request $request)
    {
        $filename = $request->getContent();
        $path = Storage::disk('public')->path('temp/' . $filename);
        
        return response()->file($path);
    }
}