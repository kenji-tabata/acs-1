<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', 'get');
$app->post('/', 'post');
$app->put('/', 'put');
$app->delete('/',  'delete');

$app->run();

function get() {
    echo "get";
}
function post() {
    echo "post";
}
function put() {
    echo "put";
}
function delete() {
    echo "delete";
}