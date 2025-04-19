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
            '10 seconds' => [10, '10 seconds'],
            '59 seconds' => [59, '59 seconds'],
        ];
    }
}