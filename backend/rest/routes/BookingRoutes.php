<?php

/**
 * @OA\Get(
 *     path="/booking",
 *     tags={"bookings"},
 *     summary="Get all bookings",
 *     @OA\Response(
 *         response=200,
 *         description="List of all bookings"
 *     )
 * )
 */
Flight::route('GET /booking', function() {
    Flight::json(Flight::bookingService()->getAll());
});

/**
 * @OA\Get(
 *     path="/booking/{id}",
 *     tags={"bookings"},
 *     summary="Get booking by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Booking ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns booking details for the given ID"
 *     )
 * )
 */
Flight::route('GET /booking/@id', function($id) {
    Flight::json(Flight::bookingService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/booking",
 *     tags={"bookings"},
 *     summary="Create a new booking",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "accommodation_id", "start_date", "end_date"},
 *             @OA\Property(property="user_id", type="integer", example=2),
 *             @OA\Property(property="accommodation_id", type="integer", example=5),
 *             @OA\Property(property="check_in", type="string", format="date", example="2025-07-01"),
 *             @OA\Property(property="check_out", type="string", format="date", example="2025-07-07"),
 *             @OA\Property(property="total_price", type="float", example=250.5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Booking successfully created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input or overlapping booking"
 *     )
 * )
 */
Flight::route('POST /booking', function() {
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::bookingService()->createBooking($data));
    } catch (Exception $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

/**
 * @OA\Put(
 *     path="/booking/{id}",
 *     tags={"bookings"},
 *     summary="Update an existing booking by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Booking ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="check_in", type="string", format="date", example="2025-07-01"),
 *             @OA\Property(property="check_out", type="string", format="date", example="2025-07-07"),
 *             @OA\Property(property="total_price", type="float", example=250.5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Booking updated successfully"
 *     )
 * )
 */
Flight::route('PUT /booking/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bookingService()->update($id, $data));
});

/**
 * @OA\Patch(
 *     path="/booking/{id}",
 *     tags={"bookings"},
 *     summary="Partially update a booking by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Booking ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="check_out", type="string", format="date", example="2025-07-07"),
 *             @OA\Property(property="total_price", type="float", example=250.5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Booking partially updated"
 *     )
 * )
 */
Flight::route('PATCH /booking/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bookingService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/booking/{id}",
 *     tags={"bookings"},
 *     summary="Delete a booking by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Booking ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Booking deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /booking/@id', function($id) {
    Flight::json(Flight::bookingService()->delete($id));
});

?>
