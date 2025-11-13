<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/AccommodationDao.php';

class AccommodationService extends BaseService {
    public function __construct() {
        $dao = new AccommodationDao();
        parent::__construct($dao);
    }

    public function checkAvailability($accommodation_id, $dates) {
        return $this->dao->checkAvailability($accommodation_id, $dates);
    }
}
?>
