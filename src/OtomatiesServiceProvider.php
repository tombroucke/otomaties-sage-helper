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
    }

    public function addBlocks() : void
    {
        foreach (glob($this->sourceFile('/app/Blocks/*.*')) as $file) {
            $publishable = [];
            $pathinfo = pathinfo($file);
            $className = $pathinfo['filename'];
            $classNameKebab = $this->toKebabCase($className);

            $associatedFiles = [
                'controller' => [
                    'source' => $this->sourceFile('/app/Blocks/' . $className . '.php'),
                    'target' => $this->app->path('Blocks/' . $className . '.php'),
                ],
                'style' => [
                    'source' => $this->sourceFile('/resources/styles/blocks/' . $classNameKebab . '.scss'),
                    'target' => $this->app->resourcePath('styles/blocks/' . $classNameKebab . '.scss'),
                ],
                'script' => [
                    'source' => $this->sourceFile('/resources/scripts/blocks/' . $classNameKebab . '.js'),
                    'target' => $this->app->resourcePath('scripts/blocks/' . $classNameKebab . '.js'),
                ],
                'view' => [
                    'source' => $this->sourceFile('/resources/views/blocks/' . $classNameKebab . '.blade.php'),
                    'target' => $this->app->resourcePath('views/blocks/' . $classNameKebab . '.blade.php'),
                ]
            ];

            foreach ($associatedFiles as $associatedFiles) {
                if (file_exists($associatedFiles['source'])) {
                    $publishable[$associatedFiles['source']] = $associatedFiles['target'];

                    if (strpos(file_get_contents($associatedFiles['source']), 'verticalAlignClass') !== false) {
                        $source = $this->sourceFile('/app/Blocks/Concerns/VerticalAlign.php');
                        $target = $this->app->path('Blocks/Concerns/VerticalAlign.php');
                        $publishable[$source] = $target;
                    }
                }
            }
            $this->publishes($publishable, 'Otomaties block ' . $className);
        }
    }

    private function sourceFile(string $path) : string
    {
        return __DIR__ . '/../publishes/' . ltrim($path, '/');
    }

    private function toKebabCase(string $slug) : string
    {
        $styleName = preg_replace('/\B([A-Z])/', '-$1', $slug);
        $styleName = strtolower($styleName);
        return $styleName;
    }
}
