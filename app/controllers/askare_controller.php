<?php

class AskareController extends BaseController {

    public static function create() {
        $luokat = Luokka::all();
        View::make('askare/new.html.twig', array('luokat'=>$luokat));
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
        Kint::dump($params);
        $askareen_luokat = $params['luokat'];
        $attributes = array(
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'kuvaus' => $params['kuvaus']
        );
//        foreach($luokat as $luokka) {
//            $attributes['luokat'][]=$luokka;
//        }   
        $askare = new Askare($attributes);
        Kint::dump($askare);
        $errors = $askare->errors();
        if (count($errors) == 0) {
            $askare->save();
            $askareen_luokat->save();
//            Kint::dump($askare);
            Redirect::to('/askare/' . $askare->id, array('message' => 'Askare lisätty!'));
        } else {
            View::make('askare/new.html.twig', array('errors' => $errors, 'askare' => $askare));
        }
    }

    public static function edit($id) {
        $askare = Askare::find($id);
        View::make('askare/edit.html.twig', array('askare' => $askare));
    }

    public function update($id) {
        $params = $_POST;
        $askare = new Askare(array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'kuvaus' => $params['kuvaus']
        ));
        $errors = $askare->errors();
        if (count($errors) == 0) {
            $askare->update($id);
//            Redirect::to('/askare/' . $id . '/edit', array('message' => 'Askaretta muokattu!'));
        } else {
            View::make('askare/edit.html.twig', array('errors' => $errors, 'askare' => $askare));
        }
    }

    public static function destroy($id) {
        $askare = new Askare(array('id' => $id));
        $askare->destroy($id);
        Redirect::to('/askare', array('message' => 'Askare poistettu'));
    }
}