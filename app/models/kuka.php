<?php

class Kuka extends BaseModel {
    
    public $id, $nimi, $salasana;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function authenticate($nimi, $salasana) {
//        Kint::dump($nimi,$salasana);
        $query = DB::connection()->prepare('select * from kuka where nimi = :nimi and salasana = :salasana limit 1');
        $query->execute(array('nimi'=>$nimi,'salasana'=>$salasana));
        $row = $query->fetch();
//        Kint::dump($row);
        if($row) {
            return new Kuka(array('id'=>$row['id'],'nimi'=>$row['nimi'],'salasana'=>$row['salasana']));
        } else {
            return null;
        }
    }
}