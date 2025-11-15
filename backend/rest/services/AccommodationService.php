<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/AccommodationDao.php';

class AccommodationService extends BaseService {
    public function __construct() {
        $dao = new AccommodationDao();
        parent::__construct($dao);
    }
       public function getAllAccommodations() {
        return $this->dao->getAllAccommodations();
    }

    public function getAccommodationById($id) {
        return $this->dao->getAccommodationById($id);
    }

    public function createAccommodation($data) {
        return $this->dao->create($data);
    }

    public function updateAccommodation($id, $data) {
        return $this->dao->updateAccommodation($id, $data);
    }

    public function deleteAccommodation($id) {
        return $this->dao->deleteAccommodation($id);
    }

    public function checkAvailability($accommodation_id, $dates) {
        if (empty($accommodation_id) || !is_numeric($accommodation_id)) {
            throw new Exception('Invalid accommodation ID.');
        }

        if (empty($dates['start_date']) || empty($dates['end_date'])) {
            throw new Exception('Start and end dates are required.');
        }

        $start = strtotime($dates['start_date']);
        $end = strtotime($dates['end_date']);
        if ($start >= $end) {
            throw new Exception('End date must be after start date.');
        }

        return $this->dao->checkAvailability($accommodation_id, $dates);
    }

}
?>
