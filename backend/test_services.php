<?php
require_once 'services/UserService.php';
require_once 'services/DestinationService.php';
require_once 'services/AccommodationService.php';
require_once 'services/BookingService.php';
require_once 'services/ReviewService.php';

$userService = new UserService();
$destinationService = new DestinationService();
$accommodationService = new AccommodationService();
$bookingService = new BookingService();
$reviewService = new ReviewService();



//$userService->registerUser('Merima Durak', 'merima@gmail.com', 'password123');
$user = $userService->loginUser('merima@gmail.com', 'password123');
echo "<pre>User:\n";
print_r($user);
echo "</pre>";

$allUsers = $userService->userDao->getAll();
echo "<pre>All users:\n";
print_r($allUsers);
echo "</pre>";


//$destinationService->addDestination('Paris', 'City of Light', 'France', 'https://example.com/paris.jpg');
$destinations = $destinationService->getAllDestinations();
echo "<pre>Destinations:\n";
print_r($destinations);
echo "</pre>";


//$accommodationService->addAccommodation(1, 'Hotel Sunshine', 'Hotel', 120.00, 'Beautiful 4-star hotel near the Eiffel Tower', 'https://example.com/hotel.jpg');
$accommodations = $accommodationService->getAccommodationsByDestination(1);
echo "<pre>Accommodations for destination 1:\n";
print_r($accommodations);
echo "</pre>";


//$bookingService->bookAccommodation(1, 1, '2025-11-01', '2025-11-05', 480.00);
$bookings = $bookingService->getUserBookings(1);
echo "<pre>Bookings for user 1:\n";
print_r($bookings);
echo "</pre>";



//$reviewService->addReview(1, 1, 5, 'Fantastic experience!');
$reviews = $reviewService->getDestinationReviews(1);
echo "<pre>Reviews for destination 1:\n";
print_r($reviews);
echo "</pre>";
?>
