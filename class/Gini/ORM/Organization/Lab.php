<?php

namespace Gini\ORM\Organization;

class Lab extends \Gini\ORM\Object
{
    public $code = 'string:10,null';
    public $name = 'string:50';
    public $department = 'object:organization/department';

    protected static $db_index = [
        'unique:code'
    ];
}


