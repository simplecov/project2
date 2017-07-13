<?php
namespace Simplecov;

class DBHandler
{
    public $tableName;

    public function dbDataEjection($tableName, $data = [])
    {
        /**
         * @TODO Год и месяц
         */
        global $wpdb;
        $query = 'SELECT * FROM' . $tableName . ' WHERE ';

        $count = 0;
        foreach ($data as $key => $value)
        {
            if(count($data) == $count)
                $query .= $key . '=' . $value;
            else
                $query .= $key . '=' . $value . 'AND';
        }
        $wpdb->get_results($query);
    }
}