<?php

namespace WSHA\AI;

use WSHA\Signals\SignalRegistry;
use WSHA\Core\Constants;

final class HealthNarrator
{
    public static function build_summary(): array
    {
        return [
            'health_score' => (int) get_option(Constants::HEALTH_SCORE_OPTION, 0),
            'trend'        => get_option(Constants::TREND_OPTION, 'stable'),
            'active_signals' => array_map(
                fn($signal) => $signal::key(),
                SignalRegistry::active_signals()
            ),
        ];
    }

    public static function explain(AIClientInterface $client): string
    {
        $summary = self::build_summary();

        $prompt = self::build_prompt($summary);

        return $client->explain($prompt);
    }

    private static function build_prompt(array $summary): string
    {
        return sprintf(
            "You are a senior WordPress engineer.\n\n".
            "Health score: %d\n".
            "Trend: %s\n".
            "Active signals: %s\n\n".
            "Explain the current risk level briefly and calmly. ".
            "Do not suggest fixes. Use probabilistic language.",
            $summary['health_score'],
            $summary['trend'],
            implode(', ', $summary['active_signals'])
        );
    }
}
