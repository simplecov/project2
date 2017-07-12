<?php
include 'Counter.class.php';
include 'form-handler.php';
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
global $cs;
add_shortcode('counter-score-form', array( '\Simplecov\CounterScore', 'getTemplate' ));

/**
 * Debug activation
 */
define('COUNTER_FORM_ERROR_ACTIVE', false);