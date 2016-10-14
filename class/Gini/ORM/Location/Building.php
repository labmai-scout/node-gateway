<?php

/**
* @brief 楼宇信息
 */
namespace Gini\ORM\Location;

class Building extends \Gini\ORM\Object
{
    // 楼宇代码
    public $code = 'string:10';
    // 楼宇名称
    public $name = 'string:50';

    // 校区
    public $campus = 'object:location/campus';

    protected static $db_index = [
        'unique:code'
    ];
}


