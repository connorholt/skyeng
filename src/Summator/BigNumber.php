<?php declare(strict_types = 1);

namespace Summator;

/**
 * Class BigNumber
 *
 * @package Summator
 */
class BigNumber implements \ArrayAccess, \IteratorAggregate
{
    private const COUNT_NUMBERS_IN_PART = 4;

    use ArrayAccessTrait;
    use IteratorAggregateTrait;

    private $number;
    private $count;
    private $container;

    /**
     * BigNumber constructor.
     *
     * @param $number
     */
    public function __construct($number)
    {
        $this->number = $number;
        $this->count = strlen($number);
        $this->fillContainer();
    }

    private function fillContainer(): void
    {
        foreach ($this->getParts() as $part) {
            if ($part === null) {
                continue;
            }

            $this->container[] = (int) $part;
        }
    }

    /**
     * Функция разбивает число в строке на части
     *
     * @return \Generator
     */
    private function getParts()
    {
        $counter = $this->count;
        do {
            yield $this->subString($this->number, $counter);
            $counter -= static::COUNT_NUMBERS_IN_PART;
        } while ($counter >= 0);

        // Выше обошли все число, но нужно проверить что не остался остаток который не учли
        $isCounterLessThanZero = $counter < 0;
        $isCounterMoreThanLast = $counter > (-1 * static::COUNT_NUMBERS_IN_PART);
        if ($isCounterLessThanZero && $isCounterMoreThanLast) {
            $length = static::COUNT_NUMBERS_IN_PART + $counter;
            yield $this->subString($this->number, 0, $length);
        }
    }

    /**
     * @param     $string
     * @param     $start
     * @param int $length
     *
     * @return string
     */
    private function subString($string, $start, $length = self::COUNT_NUMBERS_IN_PART): ?string
    {
        $subString = substr($string, $start, $length);

        return empty($subString) ? null : $subString;
    }

}