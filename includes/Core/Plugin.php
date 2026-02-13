<?php

namespace WSHA\Core;

use WSHA\Signals\SignalRegistry;
use WSHA\Scoring\HealthScoreCalculator;
use WSHA\Scoring\TrendTracker;
use WSHA\Admin\AdminMenu;
use WSHA\Admin\Ajax;
use WSHA\Alerts\AlertManager;

defined('ABSPATH') || exit;

final class Plugin
{
    public static function init(): void
    {
        SignalRegistry::register_defaults();

        // Register admin UI
        add_action('admin_menu', [AdminMenu::class, 'register']);

        // Register AJAX immediately
        \WSHA\Admin\Ajax::register();

        // Only calculate health in admin context
        if (is_admin()) {
            self::run_health_check();
        }
    }

    private static function run_health_check(): void
    {
        $score = HealthScoreCalculator::calculate();

        TrendTracker::record($score);

        \WSHA\Alerts\AlertManager::maybe_notify();
    }
}
