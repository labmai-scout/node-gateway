<?php

namespace Gini\Controller\API\Gateway;

class_exists('\Gini\Those');

class Organization extends \Gini\Controller\API implements OrganizationInterface
{
    public function actionGetSchools($criteria = null)
    {
        if (!\Gateway::isAuthorized()) return false;

        $data = [];
        $schools = those('organization/school');
        foreach ($schools as $school) {
            $data[$school->id] = [
                'code' => $school->code,
                'name' => $school->name,
            ];
        }
        return $data;
    }

    public function actionGetDepartments($criteria = null)
    {
        if (!\Gateway::isAuthorized()) return false;

        if (isset($criteria['school'])) {
            $school = a('organization/school', ['code' => $criteria['school'] ]);
            $departments = those('organization/department')->whose('school')->is($school);
        } else {
            $departments = those('organization/department');
        }

        $data = [];
        foreach ($departments as $department) {
            $data[$department->id] = [
                'school' => $department->school->code,
                'code' => $department->code,
                'name' => $department->name,
            ];
        }
        return $data;
    }

    public function actionGetLabs($criteria = null)
    {
        if (!\Gateway::isAuthorized()) return false;

        if (isset($criteria['department'])) {
            $department = a('organization/department', 
                ['code' => $criteria['department']]);
            $labs = those('organization/lab')
                ->whose('department')->is($department);
        } else {
            $labs = those('organization/lab');
        }

        $data = [];
        foreach ($labs as $lab) {
            $data[$lab->id] = [
                'department' => $lab->department->code,
                'code' => $lab->code,
                'name' => $lab->name,
            ];
        }
        return $data;
    }

    public function actionAddLab($deptCode = null, $data = null)
    {
        if (!\Gateway::isAuthorized()) return false;

        if (!$deptCode || !$data['code'] || !$data['name']) return false;

        $department = a('organization/department', 
            ['code' => $deptCode]);
        if (!$department->id) return false;

        $lab = a('organization/lab', [
            'department' => $department,
            'code' => $data['code'],
        ]);

        $lab->department = $department;
        $lab->code = $data['code'];
        $lab->name = $data['name'];
        $lab->save();
        
        return $lab->id ?: false;
    }

}
