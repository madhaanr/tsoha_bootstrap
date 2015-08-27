<?php

class AskareLuokka extends BaseModel {

    public $askare_id, $luokka_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM ASKARE_LUOKKA');
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

    public static function findByAskare($askare_id) {
        $query = DB::connection()->prepare('SELECT * FROM ASKARE_LUOKKA WHERE askare_id = :askare_id limit 1');
        $query->execute(array('askare_id' => $askare_id));
        $row = $query->fetch();
        if ($row) {
            return new Luokka(array('askare_id' => $askare_id, 'luokka_id' => $row['luokka_id']));
        } else {
            return null;
        }
    }

    public static function findByLuokka($luokka_id) {
        $query = DB::connection()->prepare('SELECT * FROM ASKARE_LUOKKA WHERE luokka_id = :luokka_id limit 1');
        $query->execute(array('luokka_id' => $luokka_id));
        $row = $query->fetch();
        if ($row) {
            return new Luokka(array('luokka_id' => $luokka_id, 'askare_id' => $row['askare_id']));
        } else {
            return null;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO ASKARE_LUOKKA (askare_id, luokka_id) VALUES (:askare_id, :luokka_id) RETURNING id');
        $query->execute(array('askare_id' => $this->askare_id, 'luokka_id' => $this->luokka_id));
//        $row = $query->fetch();
    }

//    public static function edit($id) {
//        $query = DB::connection()->prepare('select * from luokka where id = :id limit 1');
//        $query->execute(array('id' => $id));
//        $row = $query->fetch();
//        if ($row) {
//            $luokka = new Luokka(array(
//                'id' => $row['id '],
//                'nimi' => $row['nimi'],
//                'kuvaus' => $row['kuvaus'],
//            ));
//            return $luokka;
//        }
//        return null;
//    }
//
//    public function update($id) {
//        $query = DB::connection()->prepare('update luokka set nimi = :nimi, kuvaus = :kuvaus where id =:id');
//        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'id' => $id));
////        $row = $query->fetch();
////        $this->id = $row['id'];
//    }

    public function destroy($askare_id, $luokka_id) {
        $query = DB::connection()->prepare('delete from askare_luokka where askare_id =:askare_id and luokka_id=:luokka_id');
        $query->execute(array('askare_id' => $askare_id, 'luokka_id' => $luokka_id));
    }

}
