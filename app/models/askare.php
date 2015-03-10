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

}
