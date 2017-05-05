<?php

namespace App\Middleware;

use Symfony\Component\HttpFoundation\{Request, Response};

class Cors
{
    public function __invoke(Request $request, Response $response)
    {
        $response->headers->add([
            'Access-Control-Allow-Origin' => getenv('CLIENT_URL'),
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        ]);
    }
}
