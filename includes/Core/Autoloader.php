<?php

namespace WSHA\Core;

defined('ABSPATH') || exit;

final class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register([self::class, 'load']);
    }

    private static function load(string $class): void
    {
        if (strpos($class, 'WSHA\\') !== 0) {
            return;
        }

        $relative = str_replace(
            ['WSHA\\', '\\'],
            ['', DIRECTORY_SEPARATOR],
            $class
        );

        $file = plugin_dir_path(__DIR__) . $relative . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}
