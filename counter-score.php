<?php
/*
 * Plugin Name: Counter Score
 * Plugin URI:
 * Description: Counter score form and filter. Shortcode: [counter-score-form]
 * Version: 1.0.0
 * Author: Alexey Abrosimov
 * Author URI:
 * Text Domain:
 * Domain Path:
 * Network:
 * License: GPL-2.0+
 */
include 'Counter.class.php';
include 'DBHandler.class.php';


include 'form-handler.php';
add_shortcode('counter-score-form', array( '\Simplecov\CounterScore', 'getInputFormTemplate' ));
add_shortcode('counter-score-form-output', array( '\Simplecov\CounterScore', 'getOutputFormTemplate' ));

/**
 * Debug activation
 */
define('COUNTER_FORM_ERROR_ACTIVE', false);