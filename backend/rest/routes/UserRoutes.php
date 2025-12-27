<?php

/**
 * @OA\Get(
 * path="/user",
 * tags={"users"},
 * summary="Get all users",
 * security={{"BearerAuth": {}}},
 * @OA\Response(
 * response=200,
 * description="List of all users"
 * )
 * )
 */
Flight::route('GET /user', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::userService()->getAllUsers());
});

/**
 * @OA\Get(
 * path="/user/{id}",
 * tags={"users"},
 * summary="Get user by ID",
 * security={{"BearerAuth": {}}},
 * @OA\Parameter(
 * name="id",
 * in="path",
 * required=true,
 * description="ID of the user",
 * @OA\Schema(type="integer", example=1)
 * ),
 * @OA\Response(
 * response=200,
 * description="Returns a user record by ID"
 * )
 * )
 */
Flight::route('GET /user/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::userService()->getById($id));
});

/**
 * @OA\Post(
 * path="/user",
 * tags={"users"},
 * security={{"BearerAuth": {}}},
 * summary="Create a new user",
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(
 * required={"name", "email", "password"},
 * @OA\Property(property="name", type="string", example="John Doe"),
 * @OA\Property(property="email", type="string", example="ima@gmail.com"),
 * @OA\Property(property="password", type="string", example="ima"),
 * @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
 * )
 * ),
 * @OA\Response(
 * response=200,
 * description="User created successfully"
 * ),
 * @OA\Response(
 * response=400,
 * description="Invalid input or user already exists"
 * )
 * )
 */
Flight::route('POST /user', function() {

    $data = Flight::request()->data->getData();
    $errors = [];
    
    if (!isset($data['name']) || trim($data['name']) === '') $errors[] = "Name cannot be empty";
    if (!isset($data['email']) || trim($data['email']) === '') $errors[] = "Email cannot be empty";
    if (!isset($data['password']) || strlen($data['password']) < 6) $errors[] = "Password must be at least 6 characters";

    if (!empty($errors)) {
        Flight::json(["errors" => $errors], 400);
        return;
    }

    // Sigurnost: Force-iraj rolu na 'user' tako da se niko ne može sam registrovati kao 'admin'
    $data['role'] = "user"; 
    
    try {
        Flight::json(Flight::userService()->registerUser($data));
    } catch (Exception $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

/**
 * @OA\Put(
 * path="/user/{id}",
 * tags={"users"},
 * summary="Update an existing user",
 * security={{"BearerAuth": {}}},
 * @OA\Parameter(
 * name="id",
 * in="path",
 * required=true,
 * description="User ID",
 * @OA\Schema(type="integer", example=1)
 * ),
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(
 * @OA\Property(property="name", type="string", example="Updated Name"),
 * @OA\Property(property="email", type="string", example="updated.email@gmail.com"),
 * @OA\Property(property="password", type="string", example="newpassword123"),
 * @OA\Property(property="role", type="string", enum={"admin", "user"}, example="admin"),
 * @OA\Property(property="date_joined", type="string", format="date", example="2025-07-07"),
 * )
 * ),
 * @OA\Response(
 * response=200,
 * description="User updated successfully"
 * )
 * )
 */
Flight::route('PUT /user/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN]);
    $data = Flight::request()->data->getData();
    $errors = [];
    if (isset($data['name']) && trim($data['name']) === '') $errors[] = "Name cannot be empty";
    if (isset($data['email']) && trim($data['email']) === '') $errors[] = "Email cannot be empty";
    if (isset($data['password']) && strlen($data['password']) < 6) $errors[] = "Password must be at least 6 characters";

    if (!empty($errors)) {
        Flight::json(["errors" => $errors], 400);
        return;
    }
    Flight::json(Flight::userService()->update($id, $data));
});

/**
 * @OA\Delete(
 * path="/user/{id}",
 * tags={"users"},
 * summary="Delete a user by ID",
 * security={{"BearerAuth": {}}},
 * @OA\Parameter(
 * name="id",
 * in="path",
 * required=true,
 * description="ID of the user to delete",
 * @OA\Schema(type="integer", example=1)
 * ),
 * @OA\Response(
 * response=200,
 * description="User deleted successfully"
 * )
 * )
 */
Flight::route('DELETE /user/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN]);
    Flight::json(Flight::userService()->delete($id));
});

?>

