<?php

namespace WSHA\Signals;

final class SignalRegistry
{
    private static array $signals = [];

    public static function register(string $signalClass): void
    {
        self::$signals[] = $signalClass;
    }

    public static function register_defaults(): void
    {
        // Signals will be added here on Day 4+
    }

    public static function active_signals(): array
    {
        return array_filter(self::$signals, function ($signal) {
            return $signal::detect();
        });
    }
}
