<?php

namespace AttributeColors\Providers;


use Plenty\Plugin\ServiceProvider;

class AttributeColorsServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */

    public function register()
    {
      $this->getApplication()->register(AttributeColorsRouteServiceProvider::class);
      #$twig->addExtension(AttributeColorsExtension::class);
    }
}
?>
