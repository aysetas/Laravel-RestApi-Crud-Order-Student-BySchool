<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="School-Student", version="3.0.1")
 * @OA\SecurityScheme(
 *      securityScheme="X-Api-Key",
 *      in="header",
 *      name="X-Api-Key",
 *      type="apiKey",
 *  ),
 * @OA\OpenApi(
 *      security={
 *          {"apiKeyAuth": {}}
 *      }
 *  )
 *
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
