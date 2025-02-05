<?php
// app/Core/View.php

namespace App\Core;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Compilers\BladeCompiler;

class View {
    private static $factory;

    public static function init() {

        $container = Container::getInstance();


        $container->singleton('events', function() {
            return new Dispatcher();
        });


        $filesystem = new Filesystem();

        $viewPaths = [dirname(dirname(__DIR__)) . '/views'];  
        $cachePath = dirname(dirname(__DIR__)) . '/cache';   

        if (!file_exists($cachePath)) {
            mkdir($cachePath, 0755, true);
        }

        $bladeCompiler = new BladeCompiler($filesystem, $cachePath);

        $resolver = new EngineResolver;
        $resolver->register('blade', function () use ($bladeCompiler) {
            return new CompilerEngine($bladeCompiler);
        });

        $viewFinder = new FileViewFinder($filesystem, $viewPaths);

        self::$factory = new Factory(
            $resolver,
            $viewFinder,
            $container->make('events')
        );

        $bladeCompiler->directive('csrf', function () {
            return '<?php echo \'<input type="hidden" name="_token" value="\' . bin2hex(random_bytes(32)) . \'">\'; ?>';
        });

        $bladeCompiler->directive('error', function ($expression) {
            return "<?php if(isset(\$errors) && isset(\$errors[$expression])): ?>";
        });
    }

    public static function render($view, $data = []) {
        if (!self::$factory) {
            self::init();
        }
        return self::$factory->make($view, $data)->render();
    }
}