<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';


use App\Context\Shared\Domain\ValueObject\IntValueObject;

class Id extends IntValueObject
{
}

class App
{
    function run(): void
    {
        $number = 1;
        $id = new Id(1);
        echo $id->getValue();
    }
}

$app = new App();
$app->run();
