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
        $date = $post->getDate();

        $date->add(new DateInterval($days . 'd'));

        $post->setDate($date);

        $this->em->flush();
    }
}
