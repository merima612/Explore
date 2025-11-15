<?php

/**
 * @OA\Get(
 *     path="/user/{id}",
 *     tags={"users"},
 *     summary="Get user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns user data for the specified ID"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
Flight::route('GET /user/@id', function($id){
   Flight::json(Flight::userService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/user",
 *     tags={"users"},
 *     summary="Get all users",
 *     @OA\Response(
 *         response=200,
 *         description="List of all registered users"
 *     )
 * )
 */
Flight::route('GET /user', function(){
   Flight::json(Flight::userService()->getAllUsers());
});

/**
 * @OA\Post(
 *     path="/user",
 *     tags={"users"},
 *     summary="Register a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="Merima Durak"),
 *             @OA\Property(property="email", type="string", example="merima@example.com"),
 *             @OA\Property(property="password", type="string", example="strongPassword123"),
 *             @OA\Property(property="data_joined", type="string", format="date", example="2025-07-07")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User registered successfully"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input or user already exists"
 *     )
 * )
 */
Flight::route('POST /user', function(){
   $data = Flight::request()->data->getData();
   try {
       Flight::json(Flight::userService()->registerUser($data));
   } catch (Exception $e) {
       Flight::json(['error' => $e->getMessage()], 400);
   }
});

/**
 * @OA\Put(
 *     path="/user/{id}",
 *     tags={"users"},
 *     summary="Update user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Name"),
 *             @OA\Property(property="email", type="string", example="updated_email@example.com"),
 *             @OA\Property(property="data_joined", type="string", format="date", example="2025-07-07")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully"
 *     )
 * )
 */
Flight::route('PUT /user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->update($id, $data));
});

/**
 * @OA\Patch(
 *     path="/user/{id}",
 *     tags={"users"},
 *     summary="Partially update a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="email", type="string", example="newemail@example.com"),
 *             @OA\Property(property="data_joined", type="string", format="date", example="2025-07-07")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User partially updated"
 *     )
 * )
 */
Flight::route('PATCH /user/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->update($id, $data)); 
});

/**
 * @OA\Delete(
 *     path="/user/{id}",
 *     tags={"users"},
 *     summary="Delete a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /user/@id', function($id){
   Flight::json(Flight::userService()->delete($id));
});

?>
