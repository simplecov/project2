<?php

namespace Simplecov;

class CounterScore{

    private $pluginFolder;

    /**
     * @TODO убрать и работать с простым запросом
     */
    private $server;
    private $request;

    private $redirect;
    private $referer;

    private $tableName;
    private $tableCols = [
        'id',
        'firstname',
        'lastname',
        'apartment',
        'month',
        'year',
        'water_cold_1',
        'water_cold_2',
        'water_hot_1',
        'water_hot_2',
        'electricity',
        'personaldata',
    ];

    private $messages;
    private $errors;

    private $formRequestName;

    public function __construct()
    {
        $this->pluginFolder = plugin_dir_url(__FILE__);
        add_action( 'wp_enqueue_scripts', array( '\Simplecov\CounterScore', 'registerStuff' ) );

        /**
         * @TODO переделать это на register_activation_hook
         */
        $this->dbTableCreate();
        //register_activation_hook( __FILE__, array( '\Simplecov\CounterScore', 'createDBTable' ) );

        $this->setServer();
        $this->setRequest();
        $this->setFormRequestName();
    }

    /**
     * Подключаем скрипты и стили
     */
    public static function registerStuff()
    {
        wp_enqueue_script('counter-score-js', plugins_url('/js/scripts.js', __FILE__), array('jquery'));
        wp_enqueue_style('counter-score-css', plugins_url('/scss/style.css', __FILE__), array());
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
     * Задает название запроса
     */
    public function setFormRequestName()
    {
        $this->formRequestName = 'counter_score_form_request';
    }

    /**
     * Возвращает название запроса
     */
    public function getFormRequestName()
    {
        return $this->formRequestName;
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
            return false;
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
              firstname TINYTEXT NOT NULL,
              lastname TINYTEXT NOT NULL,
              apartment INT NOT NULL,
              month TINYINT NOT NULL,
              year INT NOT NULL,
              water_cold_1 INT NOT NULL,
              water_cold_2 INT NOT NULL,
              water_hot_1 INT NOT NULL,
              water_hot_2 INT NOT NULL,
              electricity INT NOT NULL,
              personaldata TINYINT NOT NULL,
              UNIQUE KEY id (id)
            );";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    /**
     * Записывает данные в таблицу
     *
     * @param $data array
     * @return bool
     */
    public function dbDataWrite($data)
    {
        global $wpdb;

        $processedData = $this->dbDataPrepare($data);
        if($processedData)
        {
            if($wpdb->insert( $this->tableName, $processedData))
            {
                $this->pinMessage('Информация успешно сохранена');
                return true;
            }
            else
            {
                $this->pinError('Ошибка сохранения информации. Попробуйте, пожалуйста, позже. Или обратитесь к администратору сайта.');
                return false;
            }
        }
    }

    /**
     * Магическим образом обрабатывает информацию для последующей записи
     *
     * @param $data array
     * @return array|bool
     */
    private function dbDataPrepare($data)
    {
        if (!is_array($data))
        {
            return false;
        }

        $arrayKeys = array_keys($data);
        if(!in_array('personaldata', $arrayKeys))
        {
            $this->pinError('Вы не дали согласие на обработку персональных данных');
            return false;
        }

        $processedData = [];
        foreach($data as $key => $value)
        {
            if(!in_array($key, $this->tableCols))
                continue;

            if(!$this->isValidated($key, $value))
                return false;

            $processedData[$key] = trim($value);
        }
        return $processedData;
    }

    private function isValidated($key, $value)
    {
        $result = true;
        switch ($key)
        {
            case 'firstname':
                if(strlen($value) > 255)
                {
                    $this->pinError('Введено более 255 символов в поле "Имя".');
                }
                else if(strlen($value) <= 0)
                {
                    $this->pinError('Вы не заполнили информацию о имени.');
                }
                else
                {
                    $this->pinMessage('Имя заполнено');
                }
                break;
            case 'lastname':
                if(strlen($value) > 255)
                {
                    $this->pinError('Введено более 255 символов в поле "Фамилия".');

                }
                else if(strlen($value) <= 0)
                {
                    $this->pinError('Вы не заполнили информацию о фамилии.');
                }
                else
                {
                    $this->pinMessage('Фамилия заполнена');
                }
                break;

            case 'apartment':
                if((int)$value <= 0)
                {
                    $this->pinError('Вы не указали номер квартиры');
                }
                else
                {
                    $this->pinMessage('Квартира указана');
                }
                break;

            case 'month':
                if((int)$value > 12)
                {
                    $this->pinError('Введено некорректное значение месяца.');
                }
                else if((int)$value <= 0)
                {
                    $this->pinError('Введено некорректное значение месяца.');
                }
                else
                {
                    $this->pinMessage('Месяц правильный');
                }
                break;

            case 'year':
                if((int)$value > 9999)
                {
                    $this->pinError('Введено некорректное значение года.');
                }
                else if((int)$value <= 2016)
                {
                    $this->pinError('Введено некорректное значение года.');
                }
                else
                {
                    $this->pinMessage('Год указан верно');
                }
                break;

            default:
                if(strlen($value ) < 0)
                {
                    $this->pinError(gettype($value));
                    $this->pinError($value);
                    $this->pinError('Введено некорректное значение счетчиков.');
                }
                else
                {
                    $this->pinMessage(gettype($value));
                    $this->pinMessage($value);
                }
                break;

        }

        if(count($this->getErrors()))
            $result = false;

        return $result;
    }

    /**
     * Записывает данные сервера
     * @return array
     */
    private function setServer()
    {
        $this->server = $_SERVER;
    }

    /**
     * Получает данные сервера
     * @return array
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Создает ссылку для перехода. Записывает в поле $this->redirect.
     *
     */
    private function createRedirectString($switch = true)
    {
        $server = $this->getServer();
        if(isset($server['HTTP_REFERER']))
        {
            if($switch)
            {
                $string = preg_replace('/\?.+/', '',  $server['HTTP_REFERER']);
                $string .= '?' . $this->getFormRequestName() . '=y';
            }
            else
            {
                $pattern = '/(&|\?)request_name=' . $this->getFormRequestName() . '/';
                $query = preg_replace($pattern, '',  $server['QUERY_STRING']);
                $string = $server['HTTP_REFERER'] . '?' . $query;
            }
        }
        else
            return false;
            //$string = $server['REQUEST_SCHEME'] . '://' . $server['SERVER_NAME'];

        $this->redirect = $string;
    }

    /**
     * Возвращает сформированную строку редиректа
     * @return string
     */
    public function getRedirectString($switch = true)
    {
        $this->createRedirectString($switch);

        return $this->redirect;
    }

}

global $cs;
$cs = new \Simplecov\CounterScore();