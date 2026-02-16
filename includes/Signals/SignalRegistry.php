<?php

namespace WSHA\Signals;

defined('ABSPATH') || exit;

final class SignalRegistry
{
    private static array $signals = [];

    public static function register(string $signalClass): void
    {
        self::$signals[] = $signalClass;
    }

    public static function register_defaults(): void
    {
        // V1: No real signals yet
        // Future signals (plugins, PHP, cron, errors) will be added here
    }

    public static function active_signals(): array
    {
        return array_filter(self::$signals, function ($signal) {
            return $signal::detect();
        });
    }
}
