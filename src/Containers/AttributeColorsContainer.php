<?php

namespace AttributeColors\Containers;

use Plenty\Plugin\Templates\Twig;

class AttributeColorsContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('AttributeColors::content.main');
    }
}
?>
