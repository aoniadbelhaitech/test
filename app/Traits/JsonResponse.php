<?php

namespace App\Traits;

trait JsonResponse {
    public function createdResponse($data)
    {
        return response()->json(
            [
                'message' => 'resource added',
                'code' => 201,
                'error' => false,
                'result' =>$data
            ], 201
        );
    }
    public function updatedResponse($data)
    {
        return response()->json(
            [
                'message' => 'resource updated',
                'code' => 200,
                'error' => false,
                'result' =>$data
            ], 200
        );
    }
    public function getResponse($data)
    {
        return response()->json(
            [
                'message' => 'resource list ',
                'code' => 200,
                'error' => false,
                'result' =>$data
            ], 200
        );
    }
    public function deletedResponse()
    {
        return response()->json(
            [
                'message' => 'resource list ',
                'code' => 204,
                'error' => false,
            ], 204
        );
    }

    public function errorResponse($code,$message)
    {
        return response()->json(
            [
                'message' => $message,
                'code' => $code,
                'error' => true,
            ], $code
        );
    }
}
