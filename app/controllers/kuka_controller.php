<?php

class KukaController extends BaseController {

    public static function login() {
        View::make('kirjautuminen/login.html.twig');
    }

    public static function handle_login() {
        $params = $_POST;
//        Kint::dump($params);
        $kuka = Kuka::authenticate($params['username'], $params['password']);
//        Kint::dump($kuka);
        if (!$kuka) {
            View::make('kirjautuminen/login.html.twig', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $kuka->id;
//            Kint::dump($kuka);
            Redirect::to('/', array('message' => 'Tervetuloa takaisin' . $kuka->nimi . '!'));
        }
    }
}