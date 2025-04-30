protected $middleware = [
    // ... existing middleware ...
    \App\Http\Middleware\SecurityHeaders::class,
];

protected $routeMiddleware = [
    // ... existing middleware ...
    'throttle.api' => \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
];