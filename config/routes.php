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

//  $routes->get('/askareenmuokkaus', function() {
//      HelloWorldController::askareenmuokkaus();
//  });
//  
//  $routes->get('/askareenlisays', function() {
//      HelloWorldController::askareenlisays();
//  });

$routes->post('/askare', function() {
    AskareController::store();
});

$routes->get('/askare/new', function() {
    AskareController::create();
});

$routes->get('/askare', function() {
    AskareController::index();
});

$routes->get('/askare/:id', function($id) {
    AskareController::find($id);
});

$routes->get('/askare/:id/edit', function($id) {
    AskareController::edit($id);
});

$routes->post('/askare/:id/edit', function($id) {
    AskareController::update($id);
});

$routes->post('/askare/:id/destroy', function($id) {
    AskareController::destroy($id);
});
