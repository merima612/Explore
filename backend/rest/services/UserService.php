<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/UserDao.php';

class UserService extends BaseService {
    public function __construct() {
        $dao = new UserDao();
        parent::__construct($dao);
    }

    public function registerUser($data) {
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            throw new Exception('All fields (name, email, password) are required.');
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format.');
        }

        if (strlen($data['password']) < 8) {
            throw new Exception('Password must be at least 8 characters long.');
        }

        if (!preg_match('/[A-Z]/', $data['password']) ||
            !preg_match('/[a-z]/', $data['password']) ||
            !preg_match('/[0-9]/', $data['password'])) {
            throw new Exception('Password must contain at least one uppercase letter, one lowercase letter, and one number.');
        }


        if (isset($data['role'])) {
            if (!in_array($data['role'], ['admin', 'user'])) {
                throw new Exception('Invalid role. Allowed values: admin, user');
            }
        } else {

            $data['role'] = 'user';
        }

        $existing = $this->dao->getByEmail($data['email']);
        if ($existing) {
            throw new Exception('Email is already registered.');
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['date_joined'] = date('Y-m-d'); 

        return $this->dao->add($data);
       
    }

    public function getAllUsers() {
        return $this->dao->getAllUsers();
    }

    public function getUserById($id) {
        return $this->dao->getUserById($id);
    }

    public function updateUser($id, $data) {
        if (isset($data['role'])) {
            if (!in_array($data['role'], ['admin', 'user'])) {
                throw new Exception('Invalid role. Allowed values: admin, user');
            }
        }

        if (!empty($data['password'])) {
            if (strlen($data['password']) < 8) {
                throw new Exception('Password must be at least 8 characters long.');
            }
            if (!preg_match('/[A-Z]/', $data['password']) ||
                !preg_match('/[a-z]/', $data['password']) ||
                !preg_match('/[0-9]/', $data['password'])) {
                throw new Exception('Password must contain at least one uppercase letter, one lowercase letter, and one number.');
            }
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        return $this->dao->updateUser($id, $data);
    }

    public function deleteUser($id) {
        return $this->dao->deleteUser($id);
    }
}
?>