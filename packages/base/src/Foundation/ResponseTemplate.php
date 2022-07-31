<?php

/*
 * @author Anas almasri (anas.almasri@merwas.net)
 * @Description: This is class for return the json template formatting
 */

namespace drafeef\base\Foundation;

use Illuminate\Http\JsonResponse;
use drafeef\base\Constants\ResponseStatus;
use Illuminate\Http\Response;

final class ResponseTemplate {


     /**
      * @param int $status_code
      * @param string|null $message
      * @param array|object $data
      * @return JsonResponse
      * @author Anas almasri (anas.almasri@merwas.net)
      * @Description This is function for return the success response template
      */

     public static function success(int $status_code , string $message = null , array|object $data = [] ): JsonResponse
     {


         return response()->json([

             'status_code' => $status_code,
             'message' => $message,
             'data' => $data,
             'status' => ResponseStatus::SUCCESS
         ]);

     }


     /**
      * @param int $status_code
      * @param string|null $message
      * @param array|object $errors
      * @return JsonResponse
      * @author Anas almasri (anas.almasri@merwas.net)
      * @Description This is function for return the success response template
      */


     public static function error(int $status_code , string $message = null , array|object $errors = [] ): JsonResponse
     {
         return response()->json([

             'status_code' => $status_code,
             'message' => $message,
             'errors' => $errors,
             'status' => ResponseStatus::ERROR
         ],Response::HTTP_BAD_REQUEST);

     }

    /**
     * @param string|null $message
     * @return JsonResponse
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This is function for return the  [ exception error ]  response template
     */


    public static function exceptionError( string $message = null ): JsonResponse
    {
        return response()->json([
            'status_code' => Response::HTTP_NOT_FOUND,
            'message' => $message,
            'status' => ResponseStatus::EXCEPTION_ERROR
        ],Response::HTTP_NOT_FOUND);

    }

    /**
     * @return JsonResponse
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This is function for return the  [ Unauthorized message]  response template
     */

    public static function unauthorized( ): JsonResponse
    {
        return response()->json([
            'status_code' => Response::HTTP_UNAUTHORIZED,
            'message' => 'unauthorized',
            'status' => ResponseStatus::UNAUTHORIZED
        ],Response::HTTP_UNAUTHORIZED);

    }

    /**
     * @return JsonResponse
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This is function for return the  [ Forbidden message]  response template
     */

    public static function forbidden( ): JsonResponse
    {
        return response()->json([
            'status_code' => Response::HTTP_FORBIDDEN,
            'message' => 'Forbidden , You Don’t Have Permission to Access on This Server',
            'status' => ResponseStatus::FORBIDDEN
        ],Response::HTTP_FORBIDDEN);

    }


    /**
     * @param int $status_code
     * @param string|null $message
     * @param array|object $data
     * @return JsonResponse
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This is function for return the pagination response template
     */


    public static function pagination(int $status_code ,  int $limit , int $page , int $total , string $message = null , array|object $data = [] ): JsonResponse
    {

        if($total >  $limit) 
            $next = true;
        else $next = false;

        return response()->json([

            'status_code' => $status_code,
            'total' => $total,
            'limit' => $limit,
            'next' => $next,
            'page' => $page,
            'message' => $message,
            'data' => $data,
            'status' => ResponseStatus::SUCCESS
        ]);

    }


 }
