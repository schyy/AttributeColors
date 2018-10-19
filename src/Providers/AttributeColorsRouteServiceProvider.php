<?php

namespace AttributeColors\Providers;


use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class AttributeColorsRouteServiceProvider extends RouteServiceProvider
{
    public function map(Router $router)
    {
      $router->get('main','AttributeColors\Controllers\ContentController@showColors');
    }
}
?>
