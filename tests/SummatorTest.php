<?php declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Summator\BigNumber;
use Summator\Summator;

/**
 * Class SummatorTest
 *
 * @package Tests
 */
class SummatorTest extends TestCase
{
    /**
     * @return array
     */
    public function additionProvider()
    {
        return [
            [
                new BigNumber("12348325982374589734895734857293874587987234234523452322123129999"),
                new BigNumber("2423422122398793129348532943485799345834985934859348"),
                "12348325982377013157018133650423223120930720033869287308057989347"
            ],
            [
                new BigNumber("2423422122398793129348532943485799345834985934859348"),
                new BigNumber("12348325982374589734895734857293874587987234234523452322123129999"),
                "12348325982377013157018133650423223120930720033869287308057989347"
            ],
            [
                new BigNumber("99999999"),
                new BigNumber("1"),
                "100000000"
            ],
            [
                new BigNumber("1"),
                new BigNumber("2"),
                "3"
            ],
        ];
    }

    /**
     * @dataProvider additionProvider
     */
    public function testSum($first, $second, $expected): void
    {
        $summator = new Summator();

        $this->assertSame(
            $expected,
            $summator->sum($first, $second)
        );
    }
}