<?php

namespace WSHA\Scoring;

use WSHA\Signals\SignalRegistry;

final class HealthScoreCalculator
{
    public static function calculate(): int
    {
        $score = 0;

        foreach (SignalRegistry::active_signals() as $signal) {
            $score += $signal::weight();
        }

        return min($score, 100);
    }
}
