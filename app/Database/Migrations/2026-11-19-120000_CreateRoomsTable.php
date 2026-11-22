<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

// Tabuľka učební pre modul M1
class CreateRoomsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
            ],
            'capacity' => [
                'type'     => 'SMALLINT',
                'unsigned' => true,
            ],
            // pocitacova, seminarna alebo prednaskova (pozri RoomModel::TYPES)
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('code', 'rooms_code_unique');
        $this->forge->addKey('type');

        // Táto collation nerozlišuje veľké a malé písmená, ale diakritiku áno.
        // Pri hľadaní "skol" sa teda nenájde "Škola" (M1-06) a kód U101 = u101 (M1-09).
        $this->forge->createTable('rooms', true, [
            'ENGINE'  => 'InnoDB',
            'COLLATE' => 'utf8mb4_uca1400_as_ci',
        ]);
    }

    public function down(): void
    {
        $this->forge->dropTable('rooms', true);
    }
}
