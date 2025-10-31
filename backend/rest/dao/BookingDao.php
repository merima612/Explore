<?php
require_once __DIR__ . "/BaseDao.php";

class BookingDao extends BaseDao {
    public function __construct() {
        parent::__construct("booking", "booking_id");
    }

    public function create($data) {
        return $this->insert($data);
    }

    public function getAllBookings() {
        return $this->getAll();
    }

    public function getBookingById($id) {
        return $this->getById($id);
    }

    public function updateBooking($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteBooking($id) {
        return $this->delete($id);
    }
}
?>
