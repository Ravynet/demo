<?php

namespace App\Services;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class ShiftPostDateService
{
    private $em;
    private $shiftDays;

    public function __construct(int $shiftDays, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->shiftDays = $shiftDays;
    }

    public function shiftPostDate(Post $post, int $days)
    {
        $date = clone $post->getDate();
        $date->modify('+'.$days.' days');
        $post->setDate($date);

        $this->em->flush();
    }
}
