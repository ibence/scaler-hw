<?php

declare(strict_types=1);

namespace Scaler\Kata;

use InvalidArgumentException;

class Formatter
{
    /**
     * @throws InvalidArgumentException
     */
    public function format(
        int $inputSeconds
    ): string {
        $this->validateSeconds($inputSeconds);

        $durationParts = new DurationParts(
            $inputSeconds,
            $inputSeconds % 60,
            intdiv($inputSeconds, 60)
        );

        return $this->present($durationParts);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function validateSeconds(
        int $inputSeconds
    ): void {
        if ($inputSeconds < 0) {
            throw new InvalidArgumentException('Seconds must be greater than or equals to 0');
        }
    }

    private function present(
        DurationParts $durationParts
    ): string {
        $seconds = $durationParts->seconds;
        $minutes = $durationParts->minutes;

        if ($minutes === 0 && $seconds === 0) {
            return 'now';
        }

        if ($minutes === 0) {
            return $this->formatUnit($seconds, 'second');
        }

        if ($seconds === 0) {
            return $this->formatUnit($minutes, 'minute');
        }

        return $this->formatUnit($minutes, 'minute') . ' and ' . $this->formatUnit($seconds, 'second');
    }

    private function formatUnit(int $value, string $unit): string
    {
        return $value === 1 ? "1 $unit" : "$value {$unit}s";
    }
}