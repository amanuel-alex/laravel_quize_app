protected $routeMiddleware = [
// other middleware
'admin' => \App\Http\Middleware\AdminMiddleware::class, // ensure this is registered
];