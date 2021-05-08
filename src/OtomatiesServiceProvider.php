<?php

namespace Otomaties\Sage;

use Roots\Acorn\ServiceProvider;

class OtomatiesServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Add blocks
        $this->addBlocks();

        // Add block template
        // $this->publishes([
        //     __DIR__ . '/../publishes/resources/components/block.blade.php' => $this->app->resourcePath('components/block.blade.php'),
        // ], 'Otomaties component block');
    }

    public function addBlocks() {

        $blocks = array(
            'carousel' => array(
                'controller' => 'Carousel.php',
                'style' => 'carousel.scss',
                'view' => 'carousel.blade.php'
            )
        );
        foreach($blocks as $key => $block) {
            $publishable = [];
            if(isset($block['controller'])) {
                $publishable[__DIR__ . '/../publishes/app/Blocks/' . $block['controller']] = $this->app->path('Blocks/' . $block['controller']);
            }
            if(isset($block['style'])) {
                $publishable[__DIR__ . '/../publishes/resources/assets/styles/blocks/' . $block['style']] = $this->app->resourcePath('assets/styles/blocks/' . $block['style']);
            }
            if(isset($block['view'])) {
                $publishable[__DIR__ . '/../publishes/resources/views/blocks/' . $block['view']] = $this->app->resourcePath('views/blocks/' . $block['view']);
            }
            $this->publishes($publishable, 'Otomaties block ' . $key);
        }
    }
}
