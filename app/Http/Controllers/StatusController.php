<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{

    /**
     * @description Check if the server is up
     */
    public function ping(): \Illuminate\Http\JsonResponse {
        return response()->json(["message" => "pong"]);
    }

    /**
     * @description This is a foo method only for post requests
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function foo(): \Illuminate\Http\JsonResponse {
        if (!request()->isMethod("post")) {
            return response()->json(["message" => "Method not allowed"], 405);
        }

        return response()->json(["message" => "bar"]);
    }

}
