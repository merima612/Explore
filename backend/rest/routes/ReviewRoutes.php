<?php

/**
 * @OA\Get(
 *     path="/review",
 *     tags={"reviews"},
 *     summary="Get all reviews",
 *     @OA\Response(
 *         response=200,
 *         description="List of all reviews"
 *     )
 * )
 */
Flight::route('GET /review', function() {
    Flight::json(Flight::reviewService()->getAll());
});

/**
 * @OA\Get(
 *     path="/review/{id}",
 *     tags={"reviews"},
 *     summary="Get review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Review ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns review details by ID"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Review not found"
 *     )
 * )
 */
Flight::route('GET /review/@id', function($id) {
    Flight::json(Flight::reviewService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/review",
 *     tags={"reviews"},
 *     summary="Create a new review",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "destination_id", "rating"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="destination_id", type="integer", example=1),
 *             @OA\Property(property="rating", type="integer", example=5, description="Rating from 1 to 5"),
 *             @OA\Property(property="comment", type="string", example="Amazing place, friendly staff, and great view!"),
 *             @OA\Property(property="date_posted", type="string", format="date", example="2024-01-15")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review successfully created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input or missing required fields"
 *     )
 * )
 */
Flight::route('POST /review', function() {
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::reviewService()->createReview($data));
    } catch (Exception $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

/**
 * @OA\Put(
 *     path="/review/{id}",
 *     tags={"reviews"},
 *     summary="Update an existing review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Review ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="rating", type="integer", example=4),
 *             @OA\Property(property="comment", type="string", example="Updated review comment")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review updated successfully"
 *     )
 * )
 */
Flight::route('PUT /review/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->update($id, $data));
});

/**
 * @OA\Patch(
 *     path="/review/{id}",
 *     tags={"reviews"},
 *     summary="Partially update a review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Review ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="rating", type="integer", example=3),
 *             @OA\Property(property="comment", type="string", example="Edited only rating")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review partially updated"
 *     )
 * )
 */
Flight::route('PATCH /review/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/review/{id}",
 *     tags={"reviews"},
 *     summary="Delete a review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Review ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /review/@id', function($id) {
    Flight::json(Flight::reviewService()->delete($id));
});

?>
