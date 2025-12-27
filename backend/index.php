<?php
/**
 * @OA\Info(
 *     title="Explore API",
 *     version="1.0.0",
 *     description="API for Explore travel application"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="BearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
require 'vendor/autoload.php';
require_once __DIR__ . '/rest/services/AuthService.php';
require_once __DIR__ . '/rest/services/UserService.php';
require_once __DIR__ . '/rest/services/BookingService.php';
require_once __DIR__ . '/rest/services/AccommodationService.php';
require_once __DIR__ . '/rest/services/DestinationService.php';
require_once __DIR__ . '/rest/services/ReviewService.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';
require_once __DIR__ . '/data/roles.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
Flight::map('notFound', function() {
    Flight::json(['error' => 'Endpoint not found'], 404);
});

Flight::map('error', function(Exception $ex) {
 
    error_log($ex->getMessage());

    Flight::json([
        'error' => 'Internal server error',
        'message' => $ex->getMessage()
    ], 500);
});

Flight::register('userService', 'UserService');
Flight::register('bookingService', 'BookingService');
Flight::register('accommodationService', 'AccommodationService');
Flight::register('destinationService', 'DestinationService');
Flight::register('reviewService', 'ReviewService');
Flight::register('auth_service', "AuthService");
Flight::register('auth_middleware', "AuthMiddleware");
Flight::route('/*', function() {
    $url = Flight::request()->url;

    if (
        strpos($url, '/auth/login') === 0 || 
        strpos($url, '/auth/register') === 0 ||
        ($url == '/user' && Flight::request()->method == 'POST')
    ) {
        return TRUE;
    } else {
        try {
    
            $token = Flight::request()->getHeader("Authorization"); 
            if(Flight::auth_middleware()->verifyToken($token))
                return TRUE;
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
});

require_once __DIR__ . '/rest/routes/AuthRoutes.php';
require_once __DIR__ . '/rest/routes/UserRoutes.php';
require_once __DIR__ . '/rest/routes/BookingRoutes.php';
require_once __DIR__ . '/rest/routes/AccommodationRoutes.php';
require_once __DIR__ . '/rest/routes/DestinationRoutes.php';
require_once __DIR__ . '/rest/routes/ReviewRoutes.php';

Flight::start();