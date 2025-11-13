<?php

/**
 * @OA\Get(
 *     path="/accommodation",
 *     tags={"accommodations"},
 *     summary="Get all accommodations",
 *     @OA\Response(
 *         response=200,
 *         description="List of all accommodations"
 *     )
 * )
 */
Flight::route('GET /accommodation', function() {
    Flight::json(Flight::accommodationService()->getAll());
});

/**
 * @OA\Get(
 *     path="/accommodation/{id}",
 *     tags={"accommodations"},
 *     summary="Get accommodation by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Accommodation ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns a single accommodation object"
 *     )
 * )
 */
Flight::route('GET /accommodation/@id', function($id) {
    Flight::json(Flight::accommodationService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/accommodation",
 *     tags={"accommodations"},
 *     summary="Create a new accommodation",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "location", "price"},
 *             @OA\Property(property="name", type="string", example="Hotel Lux"),
 *             @OA\Property(property="location", type="string", example="Sarajevo"),
 *             @OA\Property(property="price", type="number", format="float", example=120.5),
 *             @OA\Property(property="capacity", type="integer", example=3),
 *             @OA\Property(property="description", type="string", example="Modern hotel with pool and breakfast.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Accommodation successfully created"
 *     )
 * )
 */
Flight::route('POST /accommodation', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::accommodationService()->create($data));
});

/**
 * @OA\Put(
 *     path="/accommodation/{id}",
 *     tags={"accommodations"},
 *     summary="Update accommodation by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Accommodation ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Hotel"),
 *             @OA\Property(property="location", type="string", example="Mostar"),
 *             @OA\Property(property="price", type="number", format="float", example=99.99),
 *             @OA\Property(property="capacity", type="integer", example=4),
 *             @OA\Property(property="description", type="string", example="Recently renovated rooms.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Accommodation updated successfully"
 *     )
 * )
 */
Flight::route('PUT /accommodation/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::accommodationService()->update($id, $data));
});

/**
 * @OA\Patch(
 *     path="/accommodation/{id}",
 *     tags={"accommodations"},
 *     summary="Partially update accommodation by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Accommodation ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="price", type="number", format="float", example=89.99),
 *             @OA\Property(property="capacity", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Accommodation partially updated"
 *     )
 * )
 */
Flight::route('PATCH /accommodation/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::accommodationService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/accommodation/{id}",
 *     tags={"accommodations"},
 *     summary="Delete accommodation by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Accommodation ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Accommodation deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /accommodation/@id', function($id) {
    Flight::json(Flight::accommodationService()->delete($id));
});

?>
