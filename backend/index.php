<?php
require 'vendor/autoload.php';

require_once __DIR__ . '/rest/services/UserService.php';
require_once __DIR__ . '/rest/services/BookingService.php';
require_once __DIR__ . '/rest/services/AccommodationService.php';
require_once __DIR__ . '/rest/services/DestinationService.php';
require_once __DIR__ . '/rest/services/ReviewService.php';

Flight::register('userService', 'UserService');
Flight::register('bookingService', 'BookingService');
Flight::register('accommodationService', 'AccommodationService');
Flight::register('destinationService', 'DestinationService');
Flight::register('reviewService', 'ReviewService');

Flight::route('/', function() {
    echo 'Hello world!';
});

require_once __DIR__ . '/rest/routes/UserRoutes.php';
require_once __DIR__ . '/rest/routes/BookingRoutes.php';
require_once __DIR__ . '/rest/routes/AccommodationRoutes.php';
require_once __DIR__ . '/rest/routes/DestinationRoutes.php';
require_once __DIR__ . '/rest/routes/ReviewRoutes.php';

Flight::start();
?>
