<?php

declare(strict_types=1);

namespace Scaler\Kata;

use InvalidArgumentException;

class Formatter
{
    private const array UNITS = [
        'year' => 60 * 60 * 24 * 365,
        'day' => 60 * 60 * 24,
        'hour' => 60 * 60,
        'minute' => 60,
        'second' => 1,
    ];

    /**
     * @throws InvalidArgumentException
     */
    public function format(
        int $inputSeconds
    ): string {
        $this->validateInputSeconds($inputSeconds);

        if ($inputSeconds === 0) {
            return 'now';
        }

        $formattedParts = $this->getFormattedParts($inputSeconds);

        return $this->joinParts($formattedParts);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function validateInputSeconds(
        int $inputSeconds
    ): void {
        if ($inputSeconds < 0) {
            throw new InvalidArgumentException(
                'Seconds must be greater than or equals to 0'
            );
        }
    }

    private function getFormattedParts(
        int $inputSeconds
    ): array {
        $formattedParts = [];

        $remainingSeconds = $inputSeconds;
        foreach (self::UNITS as $unit => $divisor) {
            if ($remainingSeconds >= $divisor) {
                $value = intdiv($remainingSeconds, $divisor);
                $formattedParts[] = $this->formatUnit($value, $unit);
                $remainingSeconds %= $divisor;
            }
        }

        return $formattedParts;
    }

    private function formatUnit(int $value, string $unit): string
    {
        return $value . ' ' . $unit . ($value !== 1 ? 's' : '');
    }

    private function joinParts(
        array $parts
    ): string {
        if (count($parts) === 1) {
            return $parts[0];
        }

        $lastPart = array_pop($parts);

        return implode(', ', $parts) . ' and ' . $lastPart;
    }
}