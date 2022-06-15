<?php

require_once __DIR__ . '/Command.php';
require_once __DIR__ . '/ConsoleParser.php';

$logger = new Command('log', 'loggin called arguments', function ($arguments = [], $options = []){
    echo "Called command: {$this->name}\n";
    if (!empty($arguments)) {
        echo "\nArguments:\n";
        foreach ($arguments as $argument) {
            echo "   -  $argument\n";
        }
    }
    if (!empty($options)) {
        echo "\nOptions:\n";
        foreach ($options as $key => $values) {
            echo "   -  $key\n";
            foreach ($values as $value) {
                echo "        -  $value\n";
            }
        }
    }
});

$a = new ConsoleParser();
$a->register($logger);

$a->parse($argv);

