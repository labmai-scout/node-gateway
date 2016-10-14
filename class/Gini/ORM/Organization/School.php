<?php

namespace Gini\ORM\Organization;

class School extends \Gini\ORM\Object
{
    public $code = 'string:10';
    public $name = 'string:50';

    protected static $db_index = [
        'unique:code'
    ];
}


