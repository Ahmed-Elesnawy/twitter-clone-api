<?php 



namespace App\Traits;



trait ApiResponseTrait 
{
    public function successResponse($message,$code=200)
    {
        return response()->json([
            'message'     => $message,
            'status_code' => $code,
        ],$code);
    }
}