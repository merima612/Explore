<?php
require_once __DIR__ . '/../dao/AccommodationDao.php';

class AccommodationService {
    private $accommodationDao;

    public function __construct() {
        $this->accommodationDao = new AccommodationDao();
    }

    public function addAccommodation($destination_id, $name, $type, $price_per_night, $description, $image_url) {
        return $this->accommodationDao->createAccommodation($destination_id, $name, $type, $price_per_night, $description, $image_url);
    }

    public function getAccommodationsByDestination($destination_id) {
        return $this->accommodationDao->getByDestination($destination_id);
    }
}
?>
