<?php

namespace AttributeColors\Controllers;


use Plenty\Plugin\Controller;
use Plenty\Plugin\Containers;
use Plenty\Plugin\Templates\Twig;
use AttributeColors\Extensions\AttributeColorsExtension;

class ContentController extends Controller
{
    public function showColors(Twig $twig):string
    {
        $twig->addExtension(AttributeColorsExtension::class);
        return $twig->render('AttributeColors::content.colors');
    }
}
?>
