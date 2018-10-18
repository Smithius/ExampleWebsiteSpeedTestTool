<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application('PageSpeedComparison', '1.0.0');
$command = new ConsoleCommand('PageSpeedComparison');
$application->add($command);

$application
    ->setDefaultCommand($command->getName(), true)
    ->run();
