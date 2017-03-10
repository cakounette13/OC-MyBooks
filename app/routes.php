<?php

$app->get('/', function() use ($app) {
    return $app['controller.book']->findAllBooksAction($app);
})->bind('home');

$app->get('/book/{id}', function($id) use ($app) {
    return $app['controller.book']->findBookAction($id, $app);
})->bind('book');