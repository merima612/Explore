<?php
require_once __DIR__ . '/../dao/BookingDao.php';

class BookingService {
    private $bookingDao;

    public function __construct() {
        $this->bookingDao = new BookingDao();
    }

    public function bookAccommodation($user_id, $accommodation_id, $check_in, $check_out, $total_price) {
        return $this->bookingDao->createBooking($user_id, $accommodation_id, $check_in, $check_out, $total_price);
    }

    public function getUserBookings($user_id) {
        return $this->bookingDao->getBookingsByUser($user_id);
    }
}
?>
