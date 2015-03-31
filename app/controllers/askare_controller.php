<?php

class AskareController extends BaseController {

    public static function create() {
        View::make('askare/new.html.twig');
        Kint::trace();
    }
    
    public static function index() {
        $askareet = Askare::all();
        View::make('askare/askarelista.html.twig', array('askareet' => $askareet));
    }

    public static function find($id) {
        $askare = Askare::find($id);
        View::make('askare/askarenayta.html.twig', array('askare' => $askare));
    }

    public static function store() {
        $params = $_POST;
        $askare = new Askare(array(
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'luokka' => $params['luokka'],
            'kuvaus' => $params['kuvaus']
        ));
        $askare->save();
//        Kint::dump($askare);
//        Kint::dump($askare->id);
        Redirect::to('/askare/' . $askare->id, array('message' => 'Askare lisätty!'));   
    }
}