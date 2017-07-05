<?php

namespace Simplecov;

class CounterScore{

    private $pluginFolder;

    private $request;

    public function __construct()
    {
        $this->pluginFolder = plugin_dir_url(__FILE__);
        add_action( 'wp_enqueue_scripts', array( '\Simplecov\CounterScore', 'registerStuff' ) );

        /**
         * @TODO переделать это на register_activation_hook
         */
        $this->createDBTable();
        //register_activation_hook( __FILE__, array( '\Simplecov\CounterScore', 'createDBTable' ) );
    }

    /**
     * Подключаем скрипты и стили
     */
    public function registerStuff()
    {
        wp_enqueue_script('counter-score-js', plugins_url('/js/scripts.js', __FILE__), array('jquery'));
        wp_enqueue_style('counter-score-scss', plugins_url('/scss/style.scss', __FILE__), array());
    }

    /**
     * Для подключения шаблона
     */
    public static function getTemplate()
    {
        include 'form-template.php';
    }

    /**
     * Выводит на экран переданную информацию
     * @param $foo - array, int, string
     */
    public function bug($foo)
    {
        echo '<pre style="background: blue; position: relative; z-index: 1000; color: white;">';
        print_r($foo);
        echo '</pre>';
    }

    /**
     * Выводит сообщение в админку
     * @param $message - string - текст сообщения для вывода в админке
     * @param bool $error
     */
    public static function showMessage($message = 'asdasdasdasdas', $error = false)
    {
        if(strlen($message) > 0)
        {
            if($error)
                echo '<div id="message" class="error">' . $message . '</div>';
            else
                echo '<div id="message" class="updated fade">' . $message . '</div>';
        }
    }

    /**
     * Получаем данные запроса к серверу
     */
    public function getRequest()
    {
        $this->request = $_REQUEST;
        return $this->request;
    }

    /**
     * Создание таблицы
     */
    public function createDBTable()
    {
        global $wpdb;
        $tableName = $wpdb->prefix . 'counter_score_plugin';

        if($wpdb->get_var("SHOW TABLES LIKE '$tableName'") != $tableName)
        {
            $sql = "CREATE TABLE " . $tableName . " (
              id int NOT NULL AUTO_INCREMENT,
              time int DEFAULT '0' NOT NULL,
              name int NOT NULL,
              text int NOT NULL,
              url VARCHAR(55) NOT NULL,
              UNIQUE KEY id (id)
            );";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

}

new CounterScore();