<?php

namespace App\Controllers;

use App\Models\RoomModel;

// M1: učebne
class Rooms extends BaseController
{
    // US-01: zoznam učební (M1-01)
    public function index()
    {
        $model = new RoomModel();

        return view('rooms/index', [
            'title' => 'Zoznam učební',
            'rooms' => $model->orderBy('code', 'ASC')->findAll(),
        ]);
    }

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

    // US-02: formulár na pridanie učebne (M1-02)
    public function new()
    {
        return view('rooms/new', [
            'title' => 'Pridať učebňu',
            'types' => RoomModel::TYPES,
        ]);
    }

    // US-02: uloženie novej učebne (M1-02)
    public function create()
    {
        $model = new RoomModel();

        $data = $this->request->getPost(['code', 'name', 'capacity', 'type']);

        // validáciu robí model, chyby sa vo formulári zobrazia až v Sprinte 2
        if (! $model->insert($data)) {
            return redirect()->back()->withInput();
        }

        return redirect()->to('/rooms')->with('success', 'Učebňa bola pridaná.');
    }
}
