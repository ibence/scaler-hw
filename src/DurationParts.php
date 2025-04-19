<?php

namespace Scaler\Kata;

readonly class DurationParts
{
    public function __construct(
        public int $totalSeconds,
        public int $seconds,
        public int $minutes
    ) {
    }
}