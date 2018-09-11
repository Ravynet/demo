<?php

namespace App\Services;

use App\Entity\Post;
use DateInterval;
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

        $date->add(new DateInterval('P' . $days . 'D'));

        $post->setDate($date);

        $this->em->flush();
    }
}
