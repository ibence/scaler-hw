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
        int $seconds
    ): string
    {
        $this->validateSeconds($seconds);

        return 'now';
    }

    /**
     * @throws InvalidArgumentException
     */
    private function validateSeconds(
        int $seconds
    ): void
    {
        if ($seconds < 0) {
            throw new InvalidArgumentException('Seconds must be greater than or equals to 0');
        }
    }
}