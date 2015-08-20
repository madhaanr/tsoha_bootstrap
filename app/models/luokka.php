<?php

class Luokka extends BaseModel {

    public $id, $nimi, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM LUOKKA');
        $query->execute();
        $rows = $query->fetchAll();
        $luokat = array();

        foreach ($rows as $row) {
            $luokat[] = new Luokka(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $luokat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM LUOKKA WHERE id = :id limit 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return new Luokka(array('id' => $id, 'nimi' => $row['nimi'], 'kuvaus' => $row['kuvaus']));
        } else {
            return null;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO LUOKKA (nimi, kuvaus) VALUES (:nimi, :kuvaus) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        return $errors;
    }

}
