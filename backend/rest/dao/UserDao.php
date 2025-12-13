<?php
require_once __DIR__ . "/BaseDao.php";

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct("user", "user_id"); 
    }

    public function create($name, $email, $password, $role = "user") {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        return $this->insert([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            "role" => $role,
        ]);
    }

    public function getAllUsers() {
        return $this->getAll();
    }

    public function getUserById($id) {
        return $this->getById($id);
    }

    public function getByEmail($email) {
        return parent::getByEmail($email);
    }

    public function updateUser($id, $data) {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->delete($id);
    }
}
?>