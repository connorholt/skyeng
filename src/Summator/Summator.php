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
     * @param BigNumber $number
     * @param BigNumber $otherNumber
     *
     * @return string
     */
    public function sum(BigNumber $number, BigNumber $otherNumber) : string
    {
        list($firstNumber, $secondNumber) = $this->prepareNumbers($number, $otherNumber);

        $key = 0;
        foreach ($firstNumber as $key => $firstValue) {

            $secondValue = $secondNumber[$key] ?? 0;
            $bufferValue = $this->buffer[$key] ?? 0;

            /** @var int $tmpValue */
            $tmpValue = $firstValue + $secondValue + $bufferValue;

            if ($tmpValue >= static::MAX_NUMBER_IN_PART) {
                $this->addBuffer($key);
                $result = $this->generateValue($tmpValue);
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
    private function addBuffer(int $key): void
    {
        $this->buffer[$key + 1] = 1;
    }

    /**
     * Числа которые получаются больше чем MAX_NUMBER_IN_PART обрезаем
     * Чтобы сохранить часть в уме, а часть добавить в виде строки в ответ
     *
     * Работаем как со строкой, чтобы сохранить 0, при оберзка таких чисел как: 10000б 10988
     *
     * @param int $tmpValue
     *
     * @return string
     */
    private function generateValue($tmpValue =  self::MAX_NUMBER_IN_PART): string
    {
        return substr((string) $tmpValue, 1);
    }

    /**
     * @param int|string $value
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

    /**
     *
     *
     * @param BigNumber $number
     * @param BigNumber $otherNumber
     *
     * @return array
     */
    private function prepareNumbers(BigNumber $number, BigNumber $otherNumber):array
    {
        if ($number->getCount() > $otherNumber->getCount()) {
            $firstNumber = $number;
            $secondNumber = $otherNumber;
        } else {
            $firstNumber = $otherNumber;
            $secondNumber = $number;
        }

        return [
            $firstNumber,
            $secondNumber
        ];
    }
}