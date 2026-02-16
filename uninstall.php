<?php

defined('WP_UNINSTALL_PLUGIN') || exit;

delete_option('wsha_health_score');
delete_option('wsha_health_trend');
delete_option('wsha_health_band');
delete_option('wsha_previous_band');
