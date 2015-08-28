<?php

class Askare extends BaseModel {

    public $id, $nimi, $tarkeys, $kuvaus, $lisatty, $kuka_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_tarkeys');
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
                'kuka_id' => $row['kuka_id']
            ));
        }
        return $askareet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM ASKARE WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
//        $query2 = DB::connection()->prepare('SELECT * FROM ASKARE_LUOKKA WHERE askare_id = :id');
//        $query2->execute(array('id' => $id));
//        $row2 = $query2->fetchAll();
////        Kint::dump($row2);
//        $luokat = array();
//        if ($row2) {
//            foreach ($row2 as $luokka_id) {
//                $luokat[] = $luokka_id['luokka_id'];
//            }
//        }
        if ($row) {
            $askare = new Askare(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'tarkeys' => $row['tarkeys'],
                'kuvaus' => $row['kuvaus'],
                'kuka_id' => $row['kuka_id']
            ));
            return $askare;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO ASKARE (nimi, tarkeys, kuvaus, lisatty, kuka_id) VALUES (:nimi,:tarkeys,:kuvaus, NOW(),:kuka_id) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'tarkeys' => $this->tarkeys, 'kuvaus' => $this->kuvaus, 'kuka_id' => $_SESSION['user']));
        $row = $query->fetch();
        $this->id = $row['id'];
        return $this->id;
    }

    public function update($id) {
        $query = DB::connection()->prepare('update askare set nimi = :nimi, tarkeys = :tarkeys, kuvaus = :kuvaus where id=:id');
        $query->execute(array('nimi' => $this->nimi, 'tarkeys' => $this->tarkeys, 'kuvaus' => $this->kuvaus, 'id' => $id));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('delete from askare where id=:id');
        $query->execute(array('id' => $id));
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        return $errors;
    }

    public function validate_tarkeys() {
        $errors = array();
        if ($this->tarkeys == '' || $this->tarkeys == null) {
            $errors[] = 'Tärkeys ei saa olla tyhjä!';
        }
        if (!is_numeric($this->tarkeys) || $this->tarkeys < 0 || $this->tarkeys > 10) {
            $errors[] = 'Tärkeysasteen pitää olla numero väliltä 1-10';
        }
        return $errors;
    }

//     public static function edit($id) {
//        $query = DB::connection()->prepare('select * from askare where id = :id limit 1');
//        $query->execute(array('id' => $id));
//        $row = $query->fetch();
//        if ($row) {
//            $askare = new Askare(array(
//                'id' => $row['id'],
//                'nimi' => $row['nimi'],
//                'tarkeys' => $row['tarkeys'],
//                'luokka' => $row['luokka'],
//                'kuvaus' => $row['kuvaus'],
//                'lisatty' => $row['lisatty'],
//                'kuka_id' => $row['kuka_id']
//            ));
//            return $askare;
//        }
//        return null;
//    }
}
