<?php

namespace App\Controllers;

use App\Models\RoomModel;

// US-01: zoznam učební (M1-01)
class Rooms extends BaseController
{
    public function index()
    {
        $model = new RoomModel();

        return view('rooms/index', [
            'title' => 'Zoznam učební',
            'rooms' => $model->orderBy('code', 'ASC')->findAll(),
        ]);
    }
}