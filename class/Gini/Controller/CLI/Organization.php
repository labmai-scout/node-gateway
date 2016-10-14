<?php

namespace Gini\Controller\CLI;

class_exists('\Gini\Those');

class Organization extends \Gini\Controller\CLI
{
    public function __index($args)
    {
    }

    public function actionFillData()
    {
        $file = dirname(__FILE__).'/Organization.txt';
        $handler = fopen($file, 'r');
        while (($line=fgets($handler))!==false) {
            list($code, $name) = explode(',', $line);
            $parent_code = '';
            if (strlen($code)>2) {
                $parent_code = substr($code, 0, 2);
            }
            $org = a('organization');
            $org->code = trim($code);
            $org->name = trim($name);
            if ($parent_code) {
                $org->parent_code = $parent_code;
            }
            $org->save();
        }
        fclose($handler);
    }
}

