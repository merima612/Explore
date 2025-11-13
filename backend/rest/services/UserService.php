<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/UserDao.php';

class UserService extends BaseService {
    public function __construct() {
        $dao = new UserDao();
        parent::__construct($dao);
    }

    public function registerUser($data) {
        $existing = $this->dao->getByEmail($data['email']);
        if ($existing) {
            throw new Exception('Email is already registered.');
        }
        return $this->create($data);
    }
}
?>
