<?php

namespace WSHA\Scoring;

use WSHA\Core\Constants;

final class TrendTracker
{
    public static function record(int $currentScore): void
    {
        $previous = (int) get_option(Constants::HEALTH_SCORE_OPTION, 0);

        update_option(Constants::HEALTH_SCORE_OPTION, $currentScore);

        $trend = 'stable';

        if ($currentScore > $previous) {
            $trend = 'rising';
        } elseif ($currentScore < $previous) {
            $trend = 'improving';
        }

        update_option(Constants::TREND_OPTION, $trend);
    }
}
