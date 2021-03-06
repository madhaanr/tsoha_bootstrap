<?php

class LuokkaController extends BaseController {
    
    public static function index() {
        $luokat = Luokka::all();
        View::make('luokka/index.html.twig', array('luokat'=>$luokat));
    }
    
    public static function find($id) {
        $luokka = Luokka::find($id);
        View::make('luokka/show.html.twig', array('luokka'=>$luokka));
    }
    
    public static function create() {
        View::make('luokka/new.html.twig');
    }
    
    public static function store() {
        $params = $_POST;
        $luokka = new Luokka(array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus']
        ));
        $errors = $luokka->errors();

        if (count($errors) == 0) {
            $luokka->save();
            Redirect::to('/luokka/' . $luokka->id, array('message' => 'Luokka lisätty!'));
        } else {
            View::make('luokka/new.html.twig', array('errors' => $errors, 'luokka' => $luokka));
        }
    }
    
     public static function edit($id) {
        $luokka = Luokka::find($id);
        View::make('luokka/edit.html.twig', array('luokka' => $luokka));
    }

    public function update($id) {
        $params = $_POST;

        $luokka = new Luokka(array(
            'id'=>$id,
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus']
        ));

        $errors = $luokka->errors();
        if (count($errors) == 0) {
            $luokka->update($id);
//            Kint::dump($askare);
            Redirect::to('/luokka/' . $id .'/edit', array('message' => 'Luokkaa muokattu!'));
        } else {
            View::make('luokka/edit.html.twig', array('errors' => $errors, 'luokka' => $luokka));
        }
    }

    public static function destroy($id) {
        $luokka = new Luokka(array('id' => $id));
        $luokka->destroy($id);
        Redirect::to('/luokka', array('message' => 'Luokka poistettu'));
    }
}