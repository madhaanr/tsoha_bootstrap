<?php

$routes->get('/askare', function() {
    AskareController::index();
});

$routes->post('/askare', function() {
    AskareController::store();
});

$routes->get('/askare/new', function() {
    AskareController::create();
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

$routes->get('/login', function() {
    KukaController::login();
});
$routes->post('/login',function() {
    KukaController::handle_login();
});

$routes->get('/', function() {
    AskareController::index();
});
