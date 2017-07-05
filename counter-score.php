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


function myplugin_activate() {

    ?>
    <div id="message" class="error">myplugin_activate</div>
    <?
}
register_activation_hook( 'counter-score', 'myplugin_activate' );
register_activation_hook( 'counter-score', array( '\Simplecov\CounterScore', 'createDBTable' ) );

include 'Counter.class.php';
include 'form-handler.php';

$CS = new Simplecov\CounterScore();

$CS->getRequest();

$pluginFolder = plugin_dir_url(__FILE__);

add_shortcode('counter-score-form', array( '\Simplecov\CounterScore', 'getTemplate' ));
