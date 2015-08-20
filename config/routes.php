<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/askare', 'check_logged_in', function() {
    AskareController::index();
});

$routes->post('/askare', 'check_logged_in', function() {
    AskareController::store();
});

$routes->get('/askare/new', 'check_logged_in', function() {
    AskareController::create();
});

$routes->get('/askare/:id', 'check_logged_in', function($id) {
    AskareController::find($id);
});

$routes->get('/askare/:id/edit', 'check_logged_in', function($id) {
    AskareController::edit($id);
});

$routes->post('/askare/:id/edit', 'check_logged_in', function($id) {
    AskareController::update($id);
});

$routes->post('/askare/:id/destroy', 'check_logged_in', function($id) {
    AskareController::destroy($id);
});

$routes->get('/login', function() {
    KukaController::login();
});

$routes->post('/login', function() {
    KukaController::handle_login();
});

$routes->get('/', 'check_logged_in', function() {
    AskareController::index();
});

$routes->post('/logout', function() {
    KukaController::logout();
});

$routes->get('/luokka', 'check_logged_in', function() {
    LuokkaController::index();
});

$routes->post('/luokka', 'check_logged_in', function() {
    LuokkaController::store();
});

$routes->get('/luokka/new', 'check_logged_in', function() {
    LuokkaController::create();
});

$routes->get('/luokka/:id', 'check_logged_in', function($id) {
    LuokkaController::find($id);
});