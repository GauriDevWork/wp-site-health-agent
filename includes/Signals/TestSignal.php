<?php

namespace WSHA\Signals;

use WSHA\Scoring\WeightMap;

class TestSignal implements SignalInterface
{
    public static function key(): string
    {
        return 'test_signal';
    }

    public static function weight(): int
    {
        return WeightMap::HIGH;
    }

    public static function detect(): bool
    {
        return true; // Always active for testing
    }
}
