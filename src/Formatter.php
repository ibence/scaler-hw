<?php

declare(strict_types=1);

namespace Scaler\Kata;

use InvalidArgumentException;

class Formatter
{
    private const array UNITS = [
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
        $this->validateSeconds($inputSeconds);

        if ($inputSeconds === 0) {
            return 'now';
        }

        $parts = $this->getParts($inputSeconds);

        return $this->joinParts($parts);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function validateSeconds(
        int $inputSeconds
    ): void {
        if ($inputSeconds < 0) {
            throw new InvalidArgumentException(
                'Seconds must be greater than or equals to 0'
            );
        }
    }

    private function getParts(int $inputSeconds): array
    {
        $parts = [];

        $remainingSeconds = $inputSeconds;
        foreach (self::UNITS as $unit => $divisor) {
            if ($remainingSeconds >= $divisor) {
                $value = intdiv($remainingSeconds, $divisor);
                $parts[] = $value . ' ' . $unit . ($value !== 1 ? 's' : '');
                $remainingSeconds %= $divisor;
            }
        }
        return $parts;
    }

    private function joinParts(array $parts): string
    {
        if (count($parts) === 1) {
            return $parts[0];
        }

        $last = array_pop($parts);

        return implode(', ', $parts) . ' and ' . $last;
    }
}