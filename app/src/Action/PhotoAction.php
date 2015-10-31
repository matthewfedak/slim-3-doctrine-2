<?php
namespace App\Action;

use Doctrine\ORM\EntityManager;

final class PhotoAction
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function fetch($request, $response, $args)
    {
        $photos = $this->em->getRepository('App\Entity\Photo')->findAll();
        $photos = array_map(
            function ($photo) {
                return $photo->getArrayCopy();
            },
            $photos
        );
        return $response->withJSON($photos);
    }

    public function fetchOne($request, $response, $args)
    {
        $photo = $this->em->getRepository('App\Entity\Photo')->findOneBy(array('slug' => $args['slug']));
        if ($photo) {
            return $response->withJSON($photo->getArrayCopy());
        }
        return $response->withStatus(404, 'No photo found with that slug.');
    }
}
