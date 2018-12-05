<?php declare(strict_types = 1);

namespace Summator;

/**
 * Class Summator
 *
 * Складывает большие числа, которые могут не поместиться в 64 битный integer
 *
 * @package Summator
 */
class Summator
{
    private const MAX_NUMBER_IN_PART = 10000;

    /**
     * $buffer это числа которые будем хранить "в уме", как при сложении столбиком
     * @var array $buffer
     */
    private $buffer;

    /**
     * @var array
     */
    private $result;

    /**
     * @param BigNumber $firstNumber
     * @param BigNumber $secondNumber
     *
     * @return string
     */
    public function sum(BigNumber $firstNumber, BigNumber $secondNumber) : string
    {
        $key = 0;
        foreach ($firstNumber as $key => $firstValue) {

            $secondValue = $secondNumber[$key] ?? 0;
            $bufferValue = $this->buffer[$key] ?? 0;

            /** @var int $tmpValue */
            $tmpValue = $firstValue + $secondValue + $bufferValue;

            if ($tmpValue > static::MAX_NUMBER_IN_PART) {
                $this->addBuffer($key);
                $result = $this->calculateValue($tmpValue);
            } elseif ($tmpValue === static::MAX_NUMBER_IN_PART) {
                $this->addBuffer($key);
                $result = $this->generateValue();
            } else {
                $result = $tmpValue;
            }

            $this->addResult($result);
        }

        // если в буффере осталось
        $lastInBuffer = $this->buffer[$key + 1] ?? null;
        if ($lastInBuffer !== null) {
            $this->addResult($lastInBuffer);
        }

        return $this->showResult();
    }

    /**
     * @param $key
     */
    private function addBuffer($key): void
    {
        $this->buffer[$key + 1] = 1;
    }

    /**
     * @param $tmpValue
     *
     * @return int
     */
    private function calculateValue($tmpValue): int
    {
        return $tmpValue % static::MAX_NUMBER_IN_PART;
    }

    /**
     * @return string
     */
    private function generateValue(): string
    {
        return substr((string) static::MAX_NUMBER_IN_PART, 1);
    }

    /**
     * @param int $value
     */
    private function addResult($value): void
    {
        $this->result[] = $value;
    }

    /**
     * @return string
     */
    private function showResult(): string
    {
        return implode('', array_reverse($this->result));
    }
}