<?php

namespace WSHA\Admin;

defined('ABSPATH') || exit;

final class AdminMenu
{
    public static function register(): void
    {
        add_menu_page(
            'Site Health Agent',
            'Site Health Agent',
            'manage_options',
            'wsha-dashboard',
            [self::class, 'render'],
            'dashicons-heart',
            60
        );
    }

    public static function render(): void
    {
        require __DIR__ . '/DashboardView.php';
    }
}
