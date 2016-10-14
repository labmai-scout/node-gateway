<?php

/**
* @brief 房间信息
 */
namespace Gini\ORM\Location;

class Room extends \Gini\ORM\Object
{
    // 房间名称
    public $name = 'string:50';

    // 楼宇
    public $building = 'object:location/building';

    protected static $db_index = [
        'unique:name',
    ];
}


