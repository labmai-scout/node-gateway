<?php

namespace Gini\Controller\CLI;

class_exists('\Gini\Those');

class Location extends \Gini\Controller\CLI
{
    public function __index($args)
    {
    }

    public function actionFillData()
    {
        $file = dirname(__FILE__).'/Location.txt';
        $handler = fopen($file, 'r');
        while (($line=fgets($handler))!==false) {
            list($campus_code, $campus_name, $building_code, $building_name) = explode(',', $line);

            $location = a('location');
            $location->campus_code = trim($campus_code);
            $location->campus_name = trim($campus_name);
            $location->building_code = trim($building_code);
            $location->building_name = trim($building_name);
            $location->save();
        }
        fclose($handler);
    }
}

