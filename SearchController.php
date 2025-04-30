<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');
        $results = Product::search($query)->paginate(10);
        
        if ($request->ajax()) {
            return response()->json([
                'results' => view('partials.search-results', compact('results'))->render()
            ]);
        }
        
        return view('search', compact('results', 'query'));
    }
}