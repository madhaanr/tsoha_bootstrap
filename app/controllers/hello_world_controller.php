<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	View::make('home.html');
        //echo 'Tämä on etusivu';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      //echo 'Hello World!';
        View::make('helloworld.html');
    }
    
    public static function login() {
        View::make('login.html');
    }
    public static function askareet() {
        View::make('askarelista.html.twig');
    }
    
    public static function askareenmuokkaus() {
        View::make('askaremuokkaus.html.twig');
    }
    
    public static function askareenlisays() {
        View::make('askareenlisays.html.twig');
    }
  }
