<?php

namespace WSHA\Alerts;

use WSHA\Core\Constants;
use WSHA\Scoring\HealthBands;

defined('ABSPATH') || exit;

final class AlertManager
{
    public static function maybe_notify(): void
    {
        $previousBand = get_option('wsha_previous_band', 'green');
        $currentBand  = get_option('wsha_health_band', 'green');

        if ($previousBand === $currentBand) {
            return; // No transition → no alert
        }

        update_option('wsha_previous_band', $currentBand);

        self::send_digest($previousBand, $currentBand);
    }

    private static function send_digest(string $from, string $to): void
    {
        $subject = "Site Health Status Changed: {$from} → {$to}";

        $message = sprintf(
            "The site health band has changed from %s to %s.\n\n".
            "Please review the dashboard for details.\n\n".
            "This is a trend-based alert, not an emergency.",
            ucfirst($from),
            ucfirst($to)
        );

        wp_mail(get_option('admin_email'), $subject, $message);
    }
}
