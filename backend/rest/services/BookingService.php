<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/BookingDao.php';

class BookingService extends BaseService {
    public function __construct() {
        $dao = new BookingDao();
        parent::__construct($dao);
    }

    public function createBooking($data) {
        if (strtotime($data['start_date']) >= strtotime($data['end_date'])) {
            throw new Exception('End date must be after start date.');
        }
        return $this->create($data);
    }
}
?>
