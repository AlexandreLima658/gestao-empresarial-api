<?php

namespace App\Http\Controllers\Config;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    description: "API de gestão financeira empresarial",
    title: "Financial Management API"
)]

#[OA\Server(
    url: "http://127.0.0.1:8000",
    description: "Servidor local"
)]
class ApiDoc
{

}
