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
  
  $routes->get('/askareet', function() {
      HelloWorldController::askareet();
  });
  
  $routes->get('/askareenmuokkaus', function() {
      HelloWorldController::askareenmuokkaus();
  });
