<?php

/**
 * @OA\Get(
 *     path="/destination",
 *     tags={"destinations"},
 *     summary="Get all destinations",
 *     @OA\Response(
 *         response=200,
 *         description="List of all destinations"
 *     )
 * )
 */
Flight::route('GET /destination', function() {
    Flight::json(Flight::destinationService()->getAll());
});

/**
 * @OA\Get(
 *     path="/destination/{id}",
 *     tags={"destinations"},
 *     summary="Get destination by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Destination ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the destination with the given ID"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Destination not found"
 *     )
 * )
 */
Flight::route('GET /destination/@id', function($id) {
    Flight::json(Flight::destinationService()->getById($id));
});
/**
 * @OA\Post(
 *     path="/destination",
 *     tags={"destinations"},
 *     summary="Create a new destination",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "location"},
 *             @OA\Property(property="name", type="string", example="Prokoško Lake"),
 *             @OA\Property(property="description", type="string", example="Beautiful mountain lake located on Vranica mountain"),
 *             @OA\Property(property="location", type="string", example="Bosnia and Herzegovina"),
 *             @OA\Property(property="image_url", type="string", example="prokosko_lake.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Destination successfully created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /destination', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::destinationService()->create($data));
});

/**
 * @OA\Put(
 *     path="/destination/{id}",
 *     tags={"destinations"},
 *     summary="Update a destination by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Destination ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Destination"),
 *             @OA\Property(property="description", type="string", example="Updated description text""),
 *             @OA\Property(property="location", type="string", example="Herzegovina"),
 *             @OA\Property(property="image_url", type="string", example="prokosko_lake.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Destination updated successfully"
 *     )
 * )
 */
Flight::route('PUT /destination/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::destinationService()->update($id, $data));
});

/**
 * @OA\Patch(
 *     path="/destination/{id}",
 *     tags={"destinations"},
 *     summary="Partially update a destination by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Destination ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Partially updated name"),
 *             @OA\Property(property="location", type="string", example="Bosnia and Herzegovina")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Destination partially updated"
 *     )
 * )
 */
Flight::route('PATCH /destination/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::destinationService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/destination/{id}",
 *     tags={"destinations"},
 *     summary="Delete a destination by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Destination ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Destination deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /destination/@id', function($id) {
    Flight::json(Flight::destinationService()->delete($id));
});

?>
