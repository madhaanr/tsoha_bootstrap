<?php

class Luokka extends BaseModel {
    
    public $id, $nimi, $kuvaus;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
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

}