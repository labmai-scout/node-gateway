<?php

namespace Gini\Controller\API\Gateway;

class_exists('\Gini\Those');

class Location extends \Gini\Controller\API implements LocationInterface
{
    public function actionGetCampuses($criteria=null)
    {
        if (!\Gateway::isAuthorized()) return false;

        $data = [];
        $campuses = those('location/campus');
        foreach ($campuses as $campus) {
            $data[$campus->id] = [
                'code' => $campus->code,
                'name' => $campus->name,
            ];
        }
        return $data;
    }

    public function actionGetBuildings($criteria=null)
    {
        if (!\Gateway::isAuthorized()) return false;

        if (isset($criteria['campus'])) {
            $campus = a('location/campus', ['code' => $criteria['campus']]);
            $buildings = those('location/building')->whose('campus')->is($campus);
        } else {
            $buildings = those('location/building');
        }

        $data = [];
        foreach ($buildings as $building) {
            $data[$building->id] = [
                'campus' => $building->campus->code,
                'code' => $building->code,
                'name' => $building->name,
            ];
        }
        return $data;
    }

    public function actionGetRooms($criteria=null)
    {
        if (!\Gateway::isAuthorized()) return false;

        if (isset($criteria['building'])) {
            $building = a('location/building', ['code' => $criteria['building']]);
            $rooms = those('location/room')->whose('building')->is($building);
        } else {
            $rooms = those('location/room');
        }

        $data = [];
        foreach ($rooms as $room) {
            $data[$room->id] = [
                'building' => $room->building->code,
                'name' => $room->name,
            ];
        }
        return $data;
    }

    public function actionAddRoom($buildingCode = null, $data = null)
    {
        if (!\Gateway::isAuthorized()) return false;

        if (!$buildingCode || !$data['name']) return false;

        $building = a('location/building', ['code' => $buildingCode]);
        if (!$building->id) return false;

        $room = a('location/room', [
            'building' => $building,
            'name' => $data['name'],
        ]);

        $room->building = $building;
        $room->name = $data['name'];
        $room->save();
        
        return $room->id ?: false;
    }

}
