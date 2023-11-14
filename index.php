<?php

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
