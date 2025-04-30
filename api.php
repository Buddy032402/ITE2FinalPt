Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
});