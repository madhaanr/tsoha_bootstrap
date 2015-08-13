<?php

class AskareController extends BaseController {

    public static function create() {
        View::make('askare/new.html.twig');
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
        $errors = $askare->errors();
//        $askare = new Askare($attributes);
        if (count($errors) == 0) {
            $askare->save();
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
            'id'=>$id,
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'luokka' => $params['luokka'],
            'kuvaus' => $params['kuvaus']
        ));

        $errors = $askare->errors();
        if (count($errors) == 0) {
            $askare->update($id);
//            Kint::dump($askare);
            Redirect::to('/askare/' . $id .'/edit', array('message' => 'Askaretta muokattu!'));
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
