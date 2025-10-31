<?php
require_once __DIR__ . "/BaseDao.php";

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct("user", "user_id");
    }

    public function create($data) {
        return $this->insert($data);
    }

    public function getAllUsers() {
        return $this->getAll();
    }

    public function getUserById($id) {
        return $this->getById($id);
    }

    public function updateUser($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->delete($id);
    }
}
?>
