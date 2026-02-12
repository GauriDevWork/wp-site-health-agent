<?php
namespace WSHA\Scoring;
final class HealthBands
{
    public static function band(int $score): string
    {
        if ($score < 20) return 'green';
        if ($score < 50) return 'yellow';
        if ($score < 75) return 'orange';
        return 'red';
    }
}
?>