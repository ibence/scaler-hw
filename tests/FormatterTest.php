<?php

declare(strict_types=1);

namespace Scaler\Kata\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Scaler\Kata\Formatter;

class FormatterTest extends TestCase
{
    private Formatter $formatter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formatter = new Formatter();
    }

    #[DataProvider('invalidSecondsDataProvider')]
    public function test_throws_exception_if_seconds_is_invalid(
        int $seconds
    ): void {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Seconds must be greater than or equals to 0');

        $this->formatter->format($seconds);
    }

    public static function invalidSecondsDataProvider(): array
    {
        return [
            'Single negative hour' => [-1],
            'Large negative value' => [-PHP_INT_MAX],
        ];
    }

    #[DataProvider('zeroSecondsDataProvider')]
    #[DataProvider('secondsDataProvider')]
    #[DataProvider('minutesDataProvider')]
    #[DataProvider('hoursDataProvider')]
    #[DataProvider('daysDataProvider')]
    #[DataProvider('yearsDataProvider')]
    #[DataProvider('minutesWithSecondsDataProvider')]
    #[DataProvider('hoursWithOtherUnitsDataProvider')]
    #[DataProvider('daysWithOtherUnitsDataProvider')]
    #[DataProvider('yearsWithOtherUnitsDataProvider')]
    public function test_formats_duration_correctly(
        int $seconds,
        string $expected
    ): void {
        $actual = $this->formatter->format($seconds);

        $this->assertEquals($expected, $actual);
    }

    public static function zeroSecondsDataProvider(): array
    {
        return [
            'Zero seconds' => [0, 'now'],
        ];
    }

    public static function secondsDataProvider(): array
    {
        return [
            '1 second' => [1, '1 second'],
            '2 seconds' => [2, '2 seconds'],
            '59 seconds' => [59, '59 seconds'],
        ];
    }

    public static function minutesDataProvider(): array
    {
        return [
            '1 minute' => [60, '1 minute'],
            '2 minutes' => [120, '2 minutes'],
            '59 minutes' => [3540, '59 minutes'],
        ];
    }

    public static function hoursDataProvider(): array
    {
        return [
            '1 hour' => [3600, '1 hour'],
            '2 hours' => [7200, '2 hours'],
            '23 hours' => [82800, '23 hours'],
        ];
    }

    public static function daysDataProvider(): array
    {
        return [
            '1 day' => [86400, '1 day'],
            '2 days' => [172800, '2 days'],
            '364 days' => [31449600, '364 days'],
        ];
    }
    public static function yearsDataProvider(): array
    {
        return [
            '1 year' => [31536000, '1 year'],
            '2 years' => [63072000, '2 years'],
            '10 years' => [315360000, '10 years'],
            '5000 years' => [157680000000, '5000 years'],
        ];
    }

    public static function minutesWithSecondsDataProvider(): array
    {
        return [
            '1 minute and 1 second' => [61, '1 minute and 1 second'],
            '2 minutes and 1 second' => [121, '2 minutes and 1 second'],
            '1 minute and 2 seconds' => [62, '1 minute and 2 seconds'],
            '19 minutes and 2 seconds' => [1142, '19 minutes and 2 seconds'],
            '7 minutes and 48 seconds' => [468, '7 minutes and 48 seconds'],
            '59 minutes and 59 seconds' => [3599, '59 minutes and 59 seconds'],
        ];
    }

    public static function hoursWithOtherUnitsDataProvider(): array
    {
        return [
            '1 hour and 1 second' => [3601, '1 hour and 1 second'],
            '1 hour and 1 minute' => [3660, '1 hour and 1 minute'],
            '1 hour, 1 minute and 1 second' => [3661, '1 hour, 1 minute and 1 second'],
            '2 hours, 30 minutes and 45 seconds' => [9045, '2 hours, 30 minutes and 45 seconds'],
            '23 hours, 59 minutes and 59 seconds' => [86399, '23 hours, 59 minutes and 59 seconds'],
        ];
    }

    public static function daysWithOtherUnitsDataProvider(): array
    {
        return [
            '1 day and 1 hour' => [90000, '1 day and 1 hour'],
            '2 days and 5 hours' => [190800, '2 days and 5 hours'],
            '1 day, 1 hour, 1 minute and 1 second' => [90061, '1 day, 1 hour, 1 minute and 1 second'],
            '2 days, 3 hours, 4 minutes and 5 seconds' => [183845, '2 days, 3 hours, 4 minutes and 5 seconds'],
            '364 days, 23 hours, 59 minutes and 59 seconds' => [31535999, '364 days, 23 hours, 59 minutes and 59 seconds'],
        ];
    }

    public static function yearsWithOtherUnitsDataProvider(): array
    {
        return [
            '1 year and 1 second' => [31536001, '1 year and 1 second'],
            '1 year, 1 day and 1 second' => [31622401, '1 year, 1 day and 1 second'],
            '1 year, 1 day, 1 hour, 1 minute and 1 second' => [
                31626061,
                '1 year, 1 day, 1 hour, 1 minute and 1 second'
            ],
            '2 years, 3 days, 4 hours, 5 minutes and 6 seconds' => [
                63345906,
                '2 years, 3 days, 4 hours, 5 minutes and 6 seconds'
            ],
        ];
    }
}