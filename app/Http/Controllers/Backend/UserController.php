<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $this->client($request)->get("/api/users", $request->all());
        // , [], [
        //     "headers" => [
        //         'accept' => "application/json",
        //     ]
        // ]);
    }
}
