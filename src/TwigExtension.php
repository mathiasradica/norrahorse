<?php
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

namespace App;

class TwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('strtoupper', 'strtoupper')
        ];
    }
}