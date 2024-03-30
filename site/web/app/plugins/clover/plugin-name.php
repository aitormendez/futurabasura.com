<?php
/**
 * Plugin Name:     Clover
 * Plugin URI:      https://github.com/roots/clover
 * Description:     WordPress starter plugin
 * Version:         0.0.1
 * Author:          Roots
 * Author URI:      https://roots.io/
 * License:         MIT License
 * Text Domain:     clover
 * Domain Path:     /resources/lang
 */
require_once __DIR__.'/vendor/autoload.php';

$clover = new PluginNamespace\Providers\PluginNameServiceProvider;
$clover->register();

add_action('init', [$clover, 'boot']);
