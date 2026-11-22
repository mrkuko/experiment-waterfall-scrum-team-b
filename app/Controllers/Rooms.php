<?php

namespace App\Controllers;

use App\Models\RoomModel;

class Rooms extends BaseController
{
    // Detail učebne (US-05)
    public function show($id = null)
    {
        $room = (new RoomModel())->find($id);

        if ($room === null) {
            return $this->response
                ->setStatusCode(404)
                ->setBody(view('rooms/show', [
                    'title' => 'Učebňa neexistuje',
                    'room'  => null,
                ]));
        }

        return view('rooms/show', [
            'title' => 'Detail učebne',
            'room'  => $room,
        ]);
    }
}
