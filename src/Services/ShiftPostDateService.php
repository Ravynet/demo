<?php

namespace App\Services;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class ShiftPostDateService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function shiftPostDate(Post $post, int $days)
    {
        $date = clone $post->getDate();
        $date->modify('+'.$days.' days');
        $post->setDate($date);

        $this->em->flush();
    }
}
