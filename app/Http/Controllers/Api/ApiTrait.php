<?php

namespace App\Http\Controllers\Api;
use App\Models\User;

trait ApiTrait
{
    public function ApiResponse($data=null,$status=null,$message=null){
        if ($data) {
            $array = [
                'status' => $status,
                'data' => $data,
                'message' => $message
            ];
            return response($array, $status);
        }
    }
}
