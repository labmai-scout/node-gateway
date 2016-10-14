<?php

namespace Gini\ORM\Organization;

class Department extends \Gini\ORM\Object
{
    public $code = 'string:10';
    public $name = 'string:50';
    public $school = 'object:organization/school';

    protected static $db_index = [
        'unique:code'
    ];
}


