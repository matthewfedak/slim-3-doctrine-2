<?php
namespace App\Action;

use App\Resource\PhotoResource;

final class PhotoAction
{
    private $photoResource;

    public function __construct(PhotoResource $photoResource)
    {
        $this->photoResource = $photoResource;
    }

    public function fetch($request, $response, $args)
    {
        $photos = $this->photoResource->get();
        return $response->withJSON($photos);
    }

    public function fetchOne($request, $response, $args)
    {
        $photo = $this->photoResource->get($args['slug']);
        if ($photo) {
            return $response->withJSON($photo);
        }
        return $response->withStatus(404, 'No photo found with that slug.');
    }
}
