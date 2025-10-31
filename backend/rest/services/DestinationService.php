<?php
require_once __DIR__ . '/../dao/DestinationDao.php';

class DestinationService {
    private $destinationDao;

    public function __construct() {
        $this->destinationDao = new DestinationDao();
    }

    public function addDestination($name, $description, $location, $image_url) {
        return $this->destinationDao->createDestination($name, $description, $location, $image_url);
    }

    public function getAllDestinations() {
        return $this->destinationDao->getAll();
    }
}
?>
