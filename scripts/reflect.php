<?php

namespace FluentPDO;

use FluentPDO\Reflection\ReflectCommand;
use RuntimeException;

$loader = require dirname(__DIR__) . '/vendor/autoload.php';

$loader->addPsr4(__NAMESPACE__ . '\\', dirname(__DIR__));

try {
    ReflectCommand::create()->run();
} catch (RuntimeException $e) {
    echo $e->getMessage() . "\n";
    exit($e->getCode());
}
