<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    // hodnota v DB => text, ktorý vidí používateľ
    public const TYPES = [
        'pocitacova'  => 'Počítačová miestnosť',
        'seminarna'   => 'Seminárna miestnosť',
        'prednaskova' => 'Prednášková miestnosť',
    ];

    protected $table          = 'rooms';
    protected $primaryKey     = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields  = ['code', 'name', 'capacity', 'type'];
    protected $useTimestamps  = true;

    protected $validationRules = [
        // id tu musí byť, inak nefunguje {id} v is_unique
        'id'       => 'permit_empty|is_natural_no_zero',
        'code'     => 'required|max_length[20]|alpha_dash|is_unique[rooms.code,id,{id}]',
        'name'     => 'required|max_length[80]',
        'capacity' => 'required|is_natural_no_zero|less_than_equal_to[300]',
        'type'     => 'required', // in_list sa pridá v initialize()
    ];

    protected $validationMessages = [
        'code' => [
            'required'   => 'Kód je povinný.',
            'max_length' => 'Kód môže mať najviac 20 znakov.',
            'alpha_dash' => 'Kód môže obsahovať iba písmená A-Z, číslice, pomlčku a podčiarkovník.',
            'is_unique'  => 'Učebňa s týmto kódom už existuje.',
        ],
        'name' => [
            'required'   => 'Názov je povinný.',
            'max_length' => 'Názov môže mať najviac 80 znakov.',
        ],
        'capacity' => [
            'required'           => 'Kapacita je povinná.',
            'is_natural_no_zero' => 'Kapacita musí byť celé číslo od 1 do 300.',
            'less_than_equal_to' => 'Kapacita musí byť celé číslo od 1 do 300.',
        ],
        'type' => [
            'required' => 'Typ je povinný.',
            'in_list'  => 'Typ musí byť počítačová, seminárna alebo prednášková miestnosť.',
        ],
    ];

    protected function initialize(): void
    {
        $this->validationRules['type'] .= '|in_list[' . implode(',', array_keys(self::TYPES)) . ']';
    }

    public static function typeLabel(?string $type): string
    {
        return self::TYPES[$type] ?? (string) $type;
    }

    // Medzery orezávame tu, lebo beforeInsert sa volá až po validácii
    public function insert($row = null, bool $returnID = true)
    {
        return parent::insert($this->trimRow($row), $returnID);
    }

    public function update($id = null, $row = null): bool
    {
        $row = $this->trimRow($row);

        // aby pri úprave prešiel aj vlastný kód (is_unique ignoruje toto id)
        if (is_array($row) && $id !== null && ! is_array($id)) {
            $row['id'] = $id;
        }

        return parent::update($id, $row);
    }

    private function trimRow($row)
    {
        if (! is_array($row)) {
            return $row;
        }

        foreach (['code', 'name', 'capacity', 'type'] as $field) {
            if (isset($row[$field]) && is_string($row[$field])) {
                $row[$field] = trim($row[$field]);
            }
        }

        return $row;
    }
}
