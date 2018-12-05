<?php declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

function sum(string $a, string $b)
{
    if (strlen($a) > strlen($b)) {
        $firstString = $a;
        $secondString = $b;
    } else {
        $firstString = $b;
        $secondString = $a;
    }

    $firstReversedString = strrev($firstString);
    $secondReversedString = strrev($secondString);

    $buffer = 0;
    $result = [];

    $firstStringAsArray = str_split($firstReversedString);
    foreach ($firstStringAsArray as $key => $value) {
        $firstNumber = (int) $value;
        $secondNumber = (int) ($secondReversedString[$key] ?? 0);

        $resultNumber = $firstNumber + $secondNumber + $buffer;

        if ($resultNumber >= 10) {
            $buffer = 1;
            $result[] = substr((string) $resultNumber, 1);
        } else {
            $buffer = 0;
            $result[] = $resultNumber;
        }
    }

    if ($buffer != 0) {
        $result[]= $buffer;
    }

    return implode('', array_reverse($result));
}

$a = "12348325982374589734895734857293874587987234234523452322123129999";
$b = "2423422122398793129348532943485799345834985934859348";

echo sum($a, $b) . PHP_EOL;