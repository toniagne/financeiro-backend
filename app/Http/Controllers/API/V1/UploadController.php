<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function files(Request $request, $path){
        try{
            $response = $request->file('attachment')->store($path);
        }catch (\Exception $e){
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }
}
