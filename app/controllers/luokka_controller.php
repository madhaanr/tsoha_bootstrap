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
}