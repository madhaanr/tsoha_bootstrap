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
        $attributes = new Askare(array(
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'luokka' => $params['luokka'],
            'kuvaus' => $params['kuvaus']
        ));
        $askare = new Askare($attributes);
        $errors = $askare->errors();
        if (count($errors) == 0) {
            $askare->save();
            Redirect::to('/askare/' . $askare->id, array('message' => 'Askare lisätty!'));
        } else {
            View::make('askare/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
