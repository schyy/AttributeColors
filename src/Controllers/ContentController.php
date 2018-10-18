<?php

namespace AttributeColors\Controllers;


use Plenty\Plugin\Controller;
use Plenty\Plugin\Containers;
use Plenty\Plugin\Templates\Twig;

use Plenty\Modules\Item\Variation\Contracts

class ContentController extends Controller
{
    public function showColors(Twig $twig):string
    {
        return $twig->render('AttributeColors::content.colors');
    }
}
?>
