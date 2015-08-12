<?php

class Askare extends BaseModel {

    public $id, $nimi, $tarkeys, $luokka, $kuvaus, $lisatty, $kuka;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name','validate_tarkeys');
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
        $query = DB::connection()->prepare('INSERT INTO ASKARE (nimi, kuvaus, lisatty) VALUES (:nimi,:kuvaus, NOW()) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus));
//        Kint::dump($this->nimi . $this->tarkeys . $this->luokka . $this->kuvaus);
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function edit($id) {
        $query=DB::connection()->prepare('select * from askare where id = :id limit 1');
        $query->execute(array('id'=>$id));
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
    
    public static function update($id) {
        $query =DB::connection()->prepare('update askare set (nimi, kuvaus) VALUES (:nimi,:kuvaus) where id=:id');
        $query->execute(array('id'=>$id));
        
    }
    
    public function validate_name() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        return $errors;
    }
    
    public function validate_tarkeys() {
        $errors=array();
        if($this->tarkeys==''||$this->tarkeys==null) {
            $errors[] = 'Tärkeys ei saa olla tyhjä!';
        }
        if(!is_numeric($this->tarkeys)||$this->tarkeys<0||$this->tarkeys>10) {
            $errors[] = 'Tärkeysasteen pitää olla numero väliltä 1-10';
        }
        return $errors;
    }

}
