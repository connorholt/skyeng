<?php declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

$a = new Summator\BigNumber("12348325982374589734895734857293874587987234234523452322123129999");
$b = new Summator\BigNumber("2423422122398793129348532943485799345834985934859348");

//$a = new Summator\BigNumber("99999999");
//$b = new Summator\BigNumber("1");

//$a = new Summator\BigNumber("1");
//$b = new Summator\BigNumber("2");

$summator = new \Summator\Summator();

echo $summator->sum($a, $b) . PHP_EOL;


