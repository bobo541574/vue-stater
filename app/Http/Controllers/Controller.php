<?php

namespace App\Http\Controllers;

use App\Services\ApiClient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function client($request)
    {
        return (new ApiClient($request, env('APP_URL')))
            ->setHeader([
                'accept' => "application/json",
            ]);
    }
}
