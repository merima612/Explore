<?php
require_once 'rest/dao/UserDao.php';
require_once 'rest/dao/DestinationDao.php';
require_once 'rest/dao/AccommodationDao.php';
require_once 'rest/dao/BookingDao.php';
require_once 'rest/dao/ReviewDao.php';


$userDao = new UserDao();
$destinationDao = new DestinationDao();
$accommodationDao = new AccommodationDao();
$bookingDao = new BookingDao();
$reviewDao = new ReviewDao();

// -------------------------------------------------------
//  USER TEST
// -------------------------------------------------------

//$userDao->createUser('John Doe', 'john@example.com', 'password123');


$users = $userDao->getAll();
echo "<h3>All users:</h3>";
echo "<pre>";
print_r($users);
echo "</pre>";


$destinations = $destinationDao->getAll();
echo "<h3>Destinations:</h3>";
echo "<pre>";
print_r($destinations);
echo "</pre>";

$accommodations = $accommodationDao->getAll();
echo "<h3>Accommodation:</h3>";
echo "<pre>";
print_r($accommodations);
echo "</pre>";


$bookings = $bookingDao->getAll();
echo "<h3>Booking::</h3>";
echo "<pre>";
print_r($bookings);
echo "</pre>";



$reviews = $reviewDao->getAll();
echo "<h3>Reviews:</h3>";
echo "<pre>";
print_r($reviews);
echo "</pre>";
?>
