<?php

namespace WSHA\Core;

use WSHA\Signals\SignalRegistry;
use WSHA\Scoring\HealthScoreCalculator;
use WSHA\Scoring\TrendTracker;

defined('ABSPATH') || exit;

final class Plugin
{
    public static function init(): void
    {
        SignalRegistry::register_defaults();

        $score = HealthScoreCalculator::calculate();
        TrendTracker::record($score);
    }
}
