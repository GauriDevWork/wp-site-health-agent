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
        // Register signals
        SignalRegistry::register_defaults();

        // Register admin UI
        add_action('admin_menu', [AdminMenu::class, 'register']);

        // Register AJAX handlers
        Ajax::register();

        // Only run health check when our dashboard page loads
        add_action('admin_init', [self::class, 'maybe_run_health_check']);
    }

    public static function maybe_run_health_check(): void
    {
        if (!isset($_GET['page']) || $_GET['page'] !== 'wsha-dashboard') {
            return;
        }

        self::run_health_check();
    }

    private static function run_health_check(): void
    {
        $score = HealthScoreCalculator::calculate();

        TrendTracker::record($score);

        AlertManager::maybe_notify();
    }
}
