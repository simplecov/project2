<?php

namespace Simplecov;

class CounterScore{

    private $pluginFolder;

    /**
     * @TODO убрать и работать с простым запросом
     */
    private $request;

    private $tableName;

    private $errors;

    public function __construct()
    {
        $this->pluginFolder = plugin_dir_url(__FILE__);
        add_action( 'wp_enqueue_scripts', array( '\Simplecov\CounterScore', 'registerStuff' ) );

        /**
         * @TODO переделать это на register_activation_hook
         */
        $this->dbTableCreate();
        //register_activation_hook( __FILE__, array( '\Simplecov\CounterScore', 'createDBTable' ) );

        $this->setRequest();
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
     * @param $foo - mixed
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
     * Получает список ошибок
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Записывает ошибку в лог
     * @param $text
     */
    public function pinError($text)
    {
        $this->errors[] = $text;
    }

    /**
     * Записываем параметры запроса
     */
    public function setRequest()
    {
        $this->request = $_REQUEST;
    }

    /**
     * Доступ к сапросу, записанному в поле класса
     * @return array
     */
    public function getRequest($key = '')
    {
        if(strlen($key) > 0)
            return $this->request[$key];
        else
            return $this->request;
    }

    /**
     *
     * Записывает в запрос переданные параметры
     * @param $data mixed
     */
    public function insertInRequest($data)
    {
        if(is_array($data) && count($data) > 0)
        {
            foreach ($data as $key => $value)
            {
                $this->request[$key] = $value;
            }
        }
        else
            $this->request[] = $data;

    }

    /**
     * Создание таблицы
     */
    private function dbTableCreate()
    {
        global $wpdb;
        $this->tableName = $wpdb->prefix . 'counter_score_plugin';

        if($wpdb->get_var("SHOW TABLES LIKE '$this->tableName'") != $this->tableName)
        {
            $sql = "CREATE TABLE " . $this->tableName . " (
              id int NOT NULL AUTO_INCREMENT,
              firstname int NOT NULL,
              lastname int NOT NULL,
              apartment int NOT NULL,
              month int NOT NULL,
              year int NOT NULL,
              water_cold_1 int NOT NULL,
              water_cold_2 int NOT NULL,
              water_hot_1 int NOT NULL,
              water_hot_2 int NOT NULL,
              electricity int NOT NULL,
              personal int NOT NULL,
              UNIQUE KEY id (id)
            );";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    public function dbDataWrite($array)
    {
        global $wpdb;
        if (!is_array($array))
        {
            $this->bug('nifiga ne array');
            return false;
        }

//        $data = array();
//        foreach ($array as $key => $value)
//        {
//            $data[$key] = trim($value);
//        }

        if($wpdb->insert( $this->tableName, $array))
        {
            $this->bug('zapisal');
            return true;
        }
        else
        {
            $this->bug('ne zapisal');
            return false;
        }
    }

    public function dbDataPrepare($request)
    {
        $this->bug($request);
    }

}

global $cs;
$cs = new \Simplecov\CounterScore();