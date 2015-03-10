<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function() {
      HelloWorldController::login();
  });
  
  $routes->get('/askareenmuokkaus', function() {
      HelloWorldController::askareenmuokkaus();
  });
  
  $routes->get('/askareenlisays', function() {
      HelloWorldController::askareenlisays();
  });
  
  $routes->get('/askare', function() {
      AskareController::index();
  });
  
  $routes->get('/askare/:id', function($id) {
      AskareController::find($id);
  });
