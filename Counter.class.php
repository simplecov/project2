<?php

namespace Simplecov;

class CounterScore{

    private $pluginFolder;

    /**
     * @TODO убрать и работать с простым запросом
     */
    private $request;

    private $tableName;

    private $messages;
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
    public static function registerStuff()
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
     * Получает список сообщений
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Записывает сообщение в лог
     * @param $text
     */
    public function pinMessage($text)
    {
        $this->messages[] = $text;
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
    public function getRequest()
    {
            return $this->request;
    }

    /**
     * Возвращает значение массива по ключу, иначе - пустая строка
     *
     * @param string $key
     * @return string
     */
    public function getRequestValue($key = '')
    {
        if(isset($this->request[$key]))
            return $this->request[$key];
        else
            return '';
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
              id INT NOT NULL AUTO_INCREMENT,
              firstname CHAR NOT NULL,
              lastname CHAR NOT NULL,
              apartment TINYINT NOT NULL,
              month TINYINT NOT NULL,
              year YEAR NOT NULL,
              water_cold_1 SMALLINT NOT NULL,
              water_cold_2 SMALLINT NOT NULL,
              water_hot_1 SMALLINT NOT NULL,
              water_hot_2 SMALLINT NOT NULL,
              electricity SMALLINT NOT NULL,
              personal TINYINT NOT NULL,
              UNIQUE KEY id (id)
            );";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    public function dbDataWrite($data)
    {
        global $wpdb;

        $processedData = $this->dbDataPrepare($data);
        $this->pinMessage($processedData);

        if($wpdb->insert( $this->tableName, $processedData))
        {
            $this->pinMessage('zapisal');
            return true;
        }
        else
        {
            $this->pinMessage('ne zapisal');
            return false;
        }
    }

    private function dbDataPrepare($data)
    {
        if (!is_array($data))
        {
            return false;
        }

        $processedData = [];
        foreach($data as $key => $value)
        {
            $processedData[$key] = trim($value);
        }

        return $processedData;

    }

}

global $cs;
$cs = new \Simplecov\CounterScore();