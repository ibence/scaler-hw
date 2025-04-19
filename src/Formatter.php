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
            if ($seconds === 1) {
                return '1 second';
            }

            return "{$seconds} seconds";
        }

        if ($seconds === 0) {
            if ($minutes === 1) {
                return '1 minute';
            }

            return "{$minutes} minutes";
        }

        if ($minutes === 1 && $seconds === 1) {
            return "{$minutes} minute and {$seconds} second";
        }

        if ($minutes === 1) {
            return "{$minutes} minute and {$seconds} seconds";
        }

        if ($seconds === 1) {
            return "{$minutes} minutes and {$seconds} second";
        }

        return "{$minutes} minutes and {$seconds} seconds";
    }
}