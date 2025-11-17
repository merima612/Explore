<?php 
/** 
* @OA\Info( 
*     
*title="API", 

 
*     description="Explore API", 
*     version="1.0", 
*     @OA\Contact( 
*         email="merima@gmail.com", 
*         name="Web Programming" 
*     ) 
* ) 
*/ 
/** 
* @OA\Server( 
*     url= "http://localhost/Explore-milestone1/Explore/backend", 
*     description="API server" 
* ) 
*/ 
/** 
* @OA\SecurityScheme( 
*     securityScheme="ApiKey", 
*     type="apiKey", 
*     in="header", 
*     name="Authentication" 
* ) 
*/