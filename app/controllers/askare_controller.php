<?php

class AskareController extends BaseController {

    public static function create() {
        $luokat = Luokka::all();
        View::make('askare/new.html.twig', array('luokat' => $luokat));
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
        $luokka_ids = $params['luokat'];
        $askare = new Askare(array(
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'kuvaus' => $params['kuvaus']
        ));
        $errors = $askare->errors();
        if (count($errors) == 0) {
            $askare_id = $askare->save();
            Kint::dump($askare_id);
            Kint::dump($luokka_ids);
            foreach ($luokka_ids as $luokka_id) {
                $askare_luokka = new AskareLuokka(array($askare_id,(int) $luokka_id));
                $askare_luokka->save();
            }
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
