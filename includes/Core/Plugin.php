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

        $score = HealthScoreCalculator::calculate();
        TrendTracker::record($score);

        add_action('admin_menu', [AdminMenu::class, 'register']);
        add_action('init', [Ajax::class, 'register']);
        AlertManager::maybe_notify();
    }
}
