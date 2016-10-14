<?php

namespace Gini\Controller\API\Gateway;

class People extends \Gini\Controller\API implements PeopleInterface
{
    public function actionGetUser($criteria)
    {
        if (!\Gateway::isAuthorized()) return false;

        // 1. 先从本地数据库查询用户信息
        is_scalar($criteria) and $criteria = [ 'ref_no' => $criteria ];
        $criteria = array_intersect_key($criteria, ['ref_no'=>1, 'username'=>1]);

        if (isset($criteria['username'])) {
            $criteria['username'] = explode('|', $criteria['username'], 2)[0];
        }

        $user = a('user', $criteria);
        if ($user->id) {
            $info = [
                'ref_no' => $user->ref_no,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'card_no' => $user->card_no,
                'payroll_no' => $user->payroll_no,
                'department' => [
                    'code' => $user->department->code,
                    'name' => $user->department->name,
                ],
                'school' => [
                    'code' => $user->school->code,
                    'name' => $user->school->name,
                ],
                'type' => $user->type,
                '@source' => 'database'
            ];
            return $info;
        }

        return false;
    }

}
