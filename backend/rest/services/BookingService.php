<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/BookingDao.php';

class BookingService extends BaseService {
    public function __construct() {
        $dao = new BookingDao();
        parent::__construct($dao);
    }
    
    public function getAllBookings() {
        return $this->dao->getAllBookings();
    }

    public function getBookingById($id) {
        return $this->dao->getBookingById($id);
    }

    public function updateBooking($id, $data) {
        return $this->dao->updateBooking($id, $data);
    }

    public function deleteBooking($id) {
        return $this->dao->deleteBooking($id);
    }

    public function createBooking($data) {
        if (strtotime($data['start_date']) >= strtotime($data['end_date'])) {
            throw new Exception('End date must be after start date.');
        }

        $allowedAccommodation = [
            'Sarajevo' => ['Hotel'],
            'Mostar' => ['Hotel'],
            'Počitelj' => ['Hotel'],
            'Kravica Waterfall' => ['Camping'],
            'Rafting-Tara' => ['Apartment'],
            'Rafting-Neretva' => ['Apartment'],
            'Prokosko Lake' => ['Mountain Hut'],
            'Bjelašnica' => ['Hotel'],
            'Zelengora' => ['Camping'],
            'Prenj' => ['Camping']
        ];

        $destination = $data['destination'];
        $accommodation = $data['accommodation'];

        if (!isset($allowedAccommodation[$destination])) {
            throw new Exception('Invalid destination selected.');
        }

        if (!in_array($accommodation, $allowedAccommodation[$destination])) {
            throw new Exception("Accommodation type '$accommodation' is not available for destination '$destination'.");
        }

        return $this->create($data);
    }
}
?>
