<?php

/*
 * Plugin Name: Counter Score
 * Plugin URI:
 * Description: Counter score.
 * Version: 1.0.0
 * Author: Alexey Abrosimov
 * Author URI:
 * Text Domain:
 * Domain Path:
 * Network:
 * License: GPL-2.0+
 */

include 'Counter.class.php';
include 'form-handler.php';

$pluginFolder = plugin_dir_url(__FILE__);

//add_action( 'wp_enqueue_scripts', array( '\Simplecov\CounterScore', 'registerStuff' ) );
add_shortcode('counter-score-form', array( '\Simplecov\CounterScore', 'getTemplate' ));



