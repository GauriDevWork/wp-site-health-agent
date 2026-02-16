<?php

namespace WSHA\Alerts;

defined('ABSPATH') || exit;

final class AlertManager
{
    public static function maybe_notify(): void
    {
        $currentBand  = get_option('wsha_health_band');
        $previousBand = get_option('wsha_previous_band');

        // First run baseline — do not send alert
        if (!$previousBand) {
            update_option('wsha_previous_band', $currentBand);
            return;
        }

        // No change → no alert
        if ($previousBand === $currentBand) {
            return;
        }

        // Update stored band
        update_option('wsha_previous_band', $currentBand);

        self::send_digest($previousBand, $currentBand);
    }

    private static function send_digest(string $from, string $to): void
    {
        $email = get_option('admin_email');

        if (!$email || !is_email($email)) {
            return;
        }

        $subject = sprintf(
            'Site Health Status Changed: %s → %s',
            ucfirst($from),
            ucfirst($to)
        );

        $message = sprintf(
            "The site health band has changed from %s to %s.\n\n" .
            "Please review the Site Health Agent dashboard for details.\n\n" .
            "This alert is based on trend transition, not an emergency signal.",
            ucfirst($from),
            ucfirst($to)
        );

        wp_mail($email, $subject, $message);
    }
}
