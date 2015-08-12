<?php

class Askare extends BaseModel {

    public $id, $nimi, $tarkeys, $luokka, $kuvaus, $lisatty, $kuka;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM ASKARE');
        $query->execute();
        $rows = $query->fetchAll();
        $askareet = array();

        foreach ($rows as $row) {
            $askareet[] = new Askare(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'tarkeys' => $row['tarkeys'],
                'luokka' => $row['luokka'],
                'kuvaus' => $row['kuvaus'],
                'lisatty' => $row['lisatty'],
                'kuka' => $row['kuka']
            ));
        }
        return $askareet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM ASKARE WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $askare = new Askare(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'tarkeys' => $row['tarkeys'],
                'luokka' => $row['luokka'],
                'kuvaus' => $row['kuvaus'],
                'lisatty' => $row['lisatty'],
                'kuka' => $row['kuka']
            ));
            return $askare;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO ASKARE (nimi, kuvaus) VALUES (:nimi,:kuvaus) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus));
//        Kint::dump($this->nimi . $this->tarkeys . $this->luokka . $this->kuvaus);
        $row = $query->fetch();
        $this->id = $row['id'];
//        Kint::trace();
        Kint::dump($row);
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        return $errors;
    }

}
