<?php
require_once 'UserService.php';
$user_service = new UserService();
$users = $user_service->createUser(); 
print_r($users);
$existing = $user_service->getByEmail(); 
print_r($existing);
?>
