<?php

class KukaController extends BaseController {
    
    public static function login() {
        View::make('kirjautuminen/login.html.twig');
    }
    
    public static function handle_login() {
        $params=$_POST;
        
        $kuka = Kuka::authenticate($params['username'], $params['password']);
        
        if(!$kuka) {
            View::make('kirjautuminen/login.html.twig', array('error'=>'Väärä käyttäjätunnus tai salasana!','username' => $params['username']));
        } else {
            $SESSION['user']=$kuka->id;
            Redirect::to('/',array('message'=>'Tervetuloa takaisin'.$kuka->nimi .'!'));
        }
    }
    
}
