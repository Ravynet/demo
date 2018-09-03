<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ToUpperExtension extends AbstractExtension
{
    public function getFilters() {
        return [new TwigFilter('ToUpper',[$this, 'toUpper'])];
    }

    public function getFunctions() {
        return [new TwigFunction('ToUpper', [$this, 'toUpper'])];
    }

    public function toUpper($subject) {
        return strtoupper($subject);
    }
}