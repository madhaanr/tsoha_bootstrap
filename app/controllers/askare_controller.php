<?php

class AskareController extends BaseController {
    public static function index() {
        $askareet=Askare::all();
        View::make('askarelista.html', array('askareet' => $askareet));
    }
}
