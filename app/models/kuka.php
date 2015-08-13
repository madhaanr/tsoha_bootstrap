<?php

class Kuka extends BaseModel {
    
    public $id, $nimi, $salasana;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('select * from kuka where nimi=:nimi and salasana=:salasana limit 1', array('nimi'=>$nimi,'salasana'=>$salasana));
        $query->execute();
        $row = $query->fetch();
        if($row) {
            return new Kuka(array('id'=>$row['id'],'nimi'=>$row['nimi'],'salasana'=>$row['salasana']));
        } else {
            return null;
        }
    }
}
