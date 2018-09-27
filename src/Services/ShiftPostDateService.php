<?php

namespace App\Services;

use App\Entity\Post;
use DateInterval;
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
        $date = $post->getDate();

        $date->add(new DateInterval('P' . $this->shiftDays . 'D'));

        $post->setDate($date);

//        $this->em->flush();
    }
}
