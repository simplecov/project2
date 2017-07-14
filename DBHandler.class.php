<?php
namespace Simplecov;

class DBHandler
{
    private $ejectedData;
    private $personalData;
    private $counterData;

    private $tableName;
    private $tableCols = [
        'month',
        'year'
    ];
    private $presonalArrayKeys = [
        'id',
        'firstname',
        'lastname',
        'apartment',
        'month',
        'year',
        'personaldata',
    ];

    private $counterArrayKeys = [
        'water_cold_1',
        'water_cold_2',
        'water_hot_1',
        'water_hot_2',
        'electricity',
    ];

    /**
     * Возвращает полученные из таблицы данные
     * @return array
     */
    public function getEjectedData()
    {
        return $this->ejectedData;
    }

    /**
     * Запрашивает информацию из базы данных
     * @param array $data
     */
    public function dbDataEjection($data = [])
    {
        global $wpdb;
        $this->tableName = $wpdb->prefix . 'counter_score_plugin';
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE ';

        $cleanedData = $this->cleanData($data);

        $count = 0;
        foreach ($cleanedData as $key => $value)
        {
            $count++;
            if(count($cleanedData) == $count)
                $query .= $key . '=' . $value;
            else
                $query .= $key . '=' . $value . ' AND ';
        }
        $result = $wpdb->get_results($query, ARRAY_A);

        $organizeData = $this->organizeData($result);

        if(count($organizeData) > 0)
            $this->ejectedData = $organizeData;
        else
            $this->ejectedData = false;
    }

    /**
     * Очищает массив данных запроса формы от лишних для запроса к базе ключей
     * @param $data
     * @return array
     */
    private function cleanData($data)
    {
        $cleanedData = [];
        foreach ($data as $key => $value)
        {
            if(!in_array($key, $this->tableCols))
                continue;

            $cleanedData[$key] = $value;
        }

        return $cleanedData;
    }

    /**
     * Обработка масства для удобноговывода в шаблоне
     * @param $data
     * @return array
     */
    private function organizeData($data)
    {
        $organizeData = [];
        foreach($data as $result)
        {
            foreach($result as $key => $value)
            {
                if(in_array($key, $this->presonalArrayKeys))
                    $this->personalData[$key] = $value;
                else if(in_array($key, $this->counterArrayKeys))
                    $this->counterData[$key] = $value;
            }

            $separateResult = [];
            if(count($this->presonalArrayKeys) > 0)
                $separateResult['personal'] = $this->personalData;
            if(count($this->counterArrayKeys) > 0)
                $separateResult['counters'] = $this->counterData;

            $organizeData[] = $separateResult;
        }

        return $organizeData;
    }
}

global $dbcs;
$dbcs = new \Simplecov\DBHandler();