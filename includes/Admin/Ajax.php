<?php

namespace WSHA\Admin;

use WSHA\AI\HealthNarrator;
use WSHA\AI\OpenAIClient;

defined('ABSPATH') || exit;

final class Ajax
{
    public static function register(): void
    {
        add_action('wp_ajax_wsha_explain', [self::class, 'explain']);
    }

    public static function explain(): void
    {
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized');
        }

        $client = new OpenAIClient();
        $explanation = HealthNarrator::explain($client);

        wp_send_json_success($explanation);
    }
}
