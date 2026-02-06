<?php
/**
 * Plugin Name: WP Site Health Agent
 * Description: Early warning system for WordPress site degradation.
 * Version: 0.1.0
 * Author: Webtechee
 */

defined('ABSPATH') || exit;

require_once __DIR__ . '/includes/Core/Constants.php';
require_once __DIR__ . '/includes/Core/Plugin.php';

add_action('plugins_loaded', function () {
    \WSHA\Core\Plugin::init();
});
