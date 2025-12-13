<?php 
/** 
 * @OA\Info( 
 *     title="Explore API", 
 *     description="Explore Tourism API for booking destinations and accommodations", 
 *     version="1.0", 
 *     @OA\Contact( 
 *         email="merima@gmail.com", 
 *         name="Merima - Web Programming" 
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * ) 
 */ 

/** 
 * @OA\Server( 
 *     url= "http://localhost/Explore-milestone1/Explore/backend", 
 *     description="Development server" 
 * ) 
 */

/** 
 * @OA\SecurityScheme( 
 *     securityScheme="BearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Paste your JWT token here in the format: Bearer {token}"
 * ) 
 */