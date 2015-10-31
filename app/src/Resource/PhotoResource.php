<?php

namespace App\Resource;

use App\AbstractResource;

/**
 * Class Resource
 * @package App
 */
class PhotoResource extends AbstractResource
{
    /**
     * @param string|null $slug
     *
     * @return array
     */
    public function get($slug = null)
    {
        if ($slug === null) {
            $photos = $this->entityManager->getRepository('App\Entity\Photo')->findAll();
            $photos = array_map(
                function ($photo) {
                    return $photo->getArrayCopy();
                },
                $photos
            );

            return $photos;
        } else {
            $photo = $this->entityManager->getRepository('App\Entity\Photo')->findOneBy(
                array('slug' => $slug)
            );
            if ($photo) {
                return $photo->getArrayCopy();
            }
        }

        return false;
    }
}
