<?php
require_once __DIR__ . "/BaseDao.php";

class AccommodationDao extends BaseDao {
    public function __construct() {
        parent::__construct("accommodation", "accommodation_id");
    }

    public function create($data) {
        return $this->insert($data);
    }

    public function getAllAccommodations() {
        return $this->getAll();
    }

    public function getAccommodationById($id) {
        return $this->getById($id);
    }

    public function updateAccommodation($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteAccommodation($id) {
        return $this->delete($id);
    }
}
?>
