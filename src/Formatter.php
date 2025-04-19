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
    ): string
    {
        $this->validateSeconds($inputSeconds);

        $minutes = intdiv($inputSeconds, 60);
        $seconds = $inputSeconds % 60;

        return $this->present($minutes, $seconds);
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

    public function getSeconds(int $inputSeconds): string
    {
        if ($inputSeconds === 0) {
            return 'now';
        }

        if ($inputSeconds === 1) {
            return '1 second';
        }

        return "{$inputSeconds} seconds";
    }

    private function present(
        int $minutes,
        int $seconds,
    ): string {
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

        return "{$minutes} minutes and {$seconds} seconds";
    }
}