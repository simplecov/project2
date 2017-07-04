<?php

namespace Simplecov;

class CounterScore{

    private $pluginFolder;

    private $request;

    public function __construct()
    {
        $this->pluginFolder = plugin_dir_url(__FILE__);

        /**
         * Подключаем скрипты и стили
         */
        wp_enqueue_style( 'counter-score-scss', $this->pluginFolder . '/scss/counter-form-style.css', array('jquery'), '1.0', null );
        //wp_enqueue_script( 'counter-score-js', $this->pluginFolder . '/js/conter-form-scripts.js', array(), '1.0', true );


        /**
         * Создаем шорткод для шаблона
         */
        add_shortcode('counter-score', array( '\Simplecov\CounterScore', 'getTemplate' ));

    }

    public function getTemplate()
    {
        include 'form-template.php';
    }

    public function bug($foo)
    {
        echo '<pre style="background: blue; position: relative; z-index: 1000; color: white;">';
        print_r($foo);
        echo '</pre>';
    }

    public function getRequest()
    {
        $this->request = $_GET;
        $this->bug($this->request);
    }

    private function createDBTable()
    {
        global $wpdb;
        $tableName = $wpdb->prefix . 'COUNTER_SCORE';

        if($wpdb->get_var("SHOW TABLES LIKE '$tableName'") != $tableName)
        {
            $sql = "CREATE TABLE " . $tableName . " (
              id mediumint(9) NOT NULL AUTO_INCREMENT,
              time bigint(11) DEFAULT '0' NOT NULL,
              name tinytext NOT NULL,
              text text NOT NULL,
              url VARCHAR(55) NOT NULL,
              UNIQUE KEY id (id)
            );";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

}

new CounterScore();