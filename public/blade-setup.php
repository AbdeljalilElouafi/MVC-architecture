<?php
require '../vendor/autoload.php';

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Factory;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Compilers\BladeCompiler;

// Set up the file system and view paths
$fileSystem = new Filesystem();
$viewPaths = [__DIR__ . '/views'];  // Path to your Blade views
$cachePath = __DIR__ . '/cache';    // Path for Blade compiled templates

// Set up the Blade compiler and view finder
$compiler = new BladeCompiler($fileSystem, $cachePath);
$viewFinder = new FileViewFinder($fileSystem, $viewPaths);
$engine = new CompilerEngine($compiler);

// Set up the view factory
$viewFactory = new Factory($engine, $viewFinder);
