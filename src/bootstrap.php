<?php

$files = array(
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../../autoload.php'
);

$loader = false;

foreach ($files as $file) {
    if (file_exists($file)) {
        $loader = require_once $file;
        define('CLASSIFIER_PATH', dirname(dirname($file)));
        break;
    }
}

if (!$loader instanceof \Composer\Autoload\ClassLoader) {
    echo 'You must first install the vendors using composer.' . PHP_EOL;
    exit(1);
}

use Camspiers\StatisticalClassifier\Config\Config;
use Camspiers\StatisticalClassifier\Console\Command\GenerateContainerCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;



if (!file_exists(Config::getOptionPath('container_dir') . '/' . Config::getOptionPath('container_class') . '.php')) {
    $command = new GenerateContainerCommand();
    $command->run(
        new ArrayInput(array()),
        new NullOutput()
    );
}
