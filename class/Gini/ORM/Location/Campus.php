<?php

/**
* @brief 校区信息
 */
namespace Gini\ORM\Location;

class Campus extends \Gini\ORM\Object
{
    // 校区代码
    public $code = 'string:10';
    // 校区名称
    public $name = 'string:50';
    protected static $db_index = [
        'unique:code'
    ];
}


