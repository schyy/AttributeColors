<?php

namespace AttributeColors\Controllers;


use Plenty\Plugin\Controller;
use Plenty\Plugin\Containers;
use Plenty\Plugin\Templates\Twig;

class ContentController extends Controller
{
    public function showColors(Twig $twig):string
    {
        return $twig->render('AttributeColors::content.main');
    }
}
?>
