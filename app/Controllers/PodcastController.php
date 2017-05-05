<?php

namespace App\Controllers;

use App\Models\Podcast;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};
use App\Transformers\PodcastTransformer;

use League\Fractal\{
    Manager as Fractal,
    Resource\Item,
    Resource\Collection,
    Pagination\IlluminatePaginatorAdapter
};

class PodcastController
{
    protected $fractal;

    public function __construct(Fractal $fractal)
    {
        $this->fractal = $fractal;
    }

    public function index()
    {
        $podcasts = Podcast::latest()->paginate(2);

        $transformer = (new Collection($podcasts->getCollection(), new PodcastTransformer))
            ->setPaginator(new IlluminatePaginatorAdapter($podcasts));

        return new JsonResponse($this->fractal->createData($transformer)->toArray());
    }

    public function show($id)
    {
        $podcast = Podcast::find($id);

        if ($podcast === null) {
            return new Response(null, 404);
        }

        $transformer = new Item($podcast, new PodcastTransformer);

        return new JsonResponse($this->fractal->createData($transformer)->toArray());
    }
}
