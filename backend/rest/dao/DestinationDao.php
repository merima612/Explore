<?php
require_once __DIR__ . "/BaseDao.php";

class DestinationDao extends BaseDao {
    public function __construct() {
        parent::__construct("destination", "destination_id");
    }

    public function create($data) {
        return $this->insert($data);
    }

    public function getAllDestinations() {
        return $this->getAll();
    }

    public function getDestinationById($id) {
        return $this->getById($id);
    }

    public function updateDestination($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteDestination($id) {
        return $this->delete($id);
    }
}
?>
