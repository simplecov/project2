<?php
namespace Simplecov;

class DBHandler
{
    private $tableName;
    private $tableCols = [
        'month',
        'year'
    ];
    private $ejectedData = [
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

    public function getEjectedData()
    {
        return $this->ejectedData;
    }

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

        if(count($result) > 0)
        {
            $this->ejectedData = $result;
        }
        else
            $this->ejectedData = false;
    }

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
}

global $dbcs;
$dbcs = new \Simplecov\DBHandler();