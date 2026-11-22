<?php

namespace App\Database\Seeds;

use App\Models\RoomModel;
use CodeIgniter\Database\Seeder;

// Testovacie učebne z katalógu: A a B majú rôzny typ, tretí má rovnaký typ ako A
class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            ['code' => 'U101', 'name' => 'Škola',   'capacity' => 30, 'type' => 'pocitacova'],
            ['code' => 'U102', 'name' => 'Školský', 'capacity' => 30, 'type' => 'seminarna'],
            ['code' => 'U103', 'name' => 'Kabinet', 'capacity' => 30, 'type' => 'pocitacova'],
        ];

        $model = new RoomModel();

        foreach ($rooms as $room) {
            // ak už kód existuje, preskočíme ho, aby sa seeder dal pustiť viackrát
            if ($model->where('code', $room['code'])->first()) {
                continue;
            }

            if (! $model->insert($room)) {
                echo 'Chyba pri ' . $room['code'] . ': ' . implode(' ', $model->errors()) . PHP_EOL;
            }
        }
    }
}
