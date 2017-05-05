<?php

use Symfony\Component\HttpFoundation\JsonResponse;

$app->get('/podcasts', 'podcast.controller:index');
$app->get('/podcasts/{id}', 'podcast.controller:show');
