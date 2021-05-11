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

        //Add block template
        $this->publishes([
            __DIR__ . '/../publishes/resources/views/components/block.blade.php' => $this->app->resourcePath('views/components/block.blade.php'),
            __DIR__ . '/../publishes/app/View/Composers' => $this->app->resourcePath('app/View/Composers'),
            __DIR__ . '/../publishes/resources/views/partials' => $this->app->resourcePath('views/partials'),
            __DIR__ . '/../publishes/resources/assets/styles/partials' => $this->app->resourcePath('assets/styles/partials'),
            __DIR__ . '/../publishes/resources/assets/images' => $this->app->resourcePath('assets/images'),
        ], 'Otomaties default files');
    }

    public function addBlocks()
    {
        foreach (glob(__DIR__ . '/../publishes/app/Blocks/*.*') as $file) {
            $publishable = [];
            $pathinfo = pathinfo($file);
            $controllerName = $pathinfo['basename'];
            $fileName = $pathinfo['filename'];

            if (file_exists(__DIR__ . '/../publishes/app/Blocks/' . $controllerName)) {
                $publishable[__DIR__ . '/../publishes/app/Blocks/' . $controllerName] = $this->app->path('Blocks/' . $controllerName);
            }
            if (file_exists(__DIR__ . '/../publishes/resources/assets/styles/blocks/' . $this->toKebabCase($fileName) . '.scss')) {
                $publishable[__DIR__ . '/../publishes/resources/assets/styles/blocks/' . $this->toKebabCase($fileName) . '.scss'] = $this->app->resourcePath('assets/styles/blocks/' . $this->toKebabCase($fileName) . '.scss');
            }
            if (file_exists(__DIR__ . '/../publishes/resources/views/blocks/' . $this->toKebabCase($fileName) . '.blade.php')) {
                $publishable[__DIR__ . '/../publishes/resources/views/blocks/' . $this->toKebabCase($fileName) . '.blade.php'] = $this->app->resourcePath('views/blocks/' . $this->toKebabCase($fileName) . '.blade.php');
            }
            $this->publishes($publishable, 'Otomaties block ' . $fileName);
        }
    }

    private function toKebabCase($slug)
    {
        $styleName = preg_replace('/\B([A-Z])/', '-$1', $slug);
        $styleName = strtolower($styleName);
        return $styleName;
    }
}
