<?php

namespace Gini\Controller\API\Gateway;

class Auth extends \Gini\Controller\API
{
    public function actionVerify($username, $password)
    {
        $sql = 'SELECT "ref_no" FROM "user" WHERE "ref_no"=:ref_no AND "password"=:password';
        $params = [
            ':ref_no'=> $username,
            ':password' => $password,
        ];
        $db = \Gini\Database::db();
        return !!$db->value($sql, null, $params);
    }
    
}
