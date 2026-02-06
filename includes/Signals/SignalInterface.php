<?php

namespace WSHA\Signals;

interface SignalInterface
{
    public static function key(): string;

    public static function weight(): int;

    public static function detect(): bool;
}
