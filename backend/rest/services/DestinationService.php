<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/DestinationDao.php';

class DestinationService extends BaseService {
    public function __construct() {
        $dao = new DestinationDao();
        parent::__construct($dao);
    }

    public function getAllDestinations() {
        return $this->dao->getAllDestinations();
    }

    public function getDestinationById($id) {
        return $this->dao->getDestinationById($id);
    }

    public function createDestination($data) {
        return $this->dao->create($data);
    }

    public function updateDestination($id, $data) {
        return $this->dao->updateDestination($id, $data);
    }

    public function deleteDestination($id) {
        return $this->dao->deleteDestination($id);
    }

}
?>
