<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;

/**
 * @group Product Management
 *
 * APIs for managing products
 */
class ProductController extends Controller
{
    /**
     * List all products
     * 
     * Get a paginated list of all products.
     *
     * @queryParam page integer The page number. Example: 1
     * @queryParam per_page integer Number of items per page. Example: 10
     *
     * @response {
     *  "data": [
     *    {
     *      "id": 1,
     *      "name": "Product Name",
     *      "description": "Product Description",
     *      "price": "99.99",
     *      "category": {
     *        "id": 1,
     *        "name": "Category Name"
     *      }
     *    }
     *  ],
     *  "links": {},
     *  "meta": {}
     * }
     */
    public function index()
    {
        $products = Product::with('category')->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Create a new product
     *
     * @bodyParam name string required The name of the product. Example: New Product
     * @bodyParam description string required The product description. Example: Product details
     * @bodyParam price numeric required The product price. Example: 99.99
     * @bodyParam category_id integer required The category ID. Example: 1
     *
     * @response 201 {
     *  "data": {
     *    "id": 1,
     *    "name": "New Product",
     *    "description": "Product details",
     *    "price": "99.99",
     *    "category": {
     *      "id": 1,
     *      "name": "Category Name"
     *    }
     *  }
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = Product::create($validated);
        return new ProductResource($product);
    }
}