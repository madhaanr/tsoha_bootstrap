<?php

class AskareController extends BaseController {
    
    public static function index() {
        $askareet=Askare::all();
        View::make('askare/askarelista.html.twig', array('askareet' => $askareet));
    }
    
    public static function find($id) {
        $askare=Askare::find($id);
        View::make('askare/askarenayta.html.twig', array('askare' => $askare));
    }
}
