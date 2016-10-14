<?php

namespace Gini\ORM;

class User extends Object
{
    public $name = 'string:120';
    public $password = 'string:40';
    //学号
    public $ref_no = 'string:40';
    //卡号
    public $card_no = 'string:40';

    // 工资号
    public $payroll_no = 'string:80';

    // 用户类型
    public $type = 'string:40';

    // 单位
    public $department = 'object:organization/department';
    public $school = 'object:organization/school';

    // 联系方式
    public $phone = 'string:120';
    public $email = 'string:120';

    public $username = 'string:120,null';

    protected static $db_index = [
        'unique:ref_no',
        'unique:username'
    ];
}