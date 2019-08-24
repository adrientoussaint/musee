<?php

$app->get('/', '\App\Controller\HomeController:home');

$app->get('/home', '\App\Controller\HomeController:home');

$app->post('/home/newsletterSubscribed', '\App\Controller\HomeController:newsletterSubscribed');

$app->get('/mentions', '\App\Controller\LegalController:mentions');

$app->get('/plan', '\App\Controller\LegalController:plan');

// $app->get('/collection', '\App\Controller\CollectionController:home');

// $app->get('/detail[/{id}]', '\App\Controller\CollectionController:car');

// $app->get('/insert', '\App\Controller\MyController:insert');

// $app->get('/access', '\App\Controller\AccessController:access');





// $app->get('/login', '\App\Controller\AdminController:login');

// $app->post('/admin', '\App\Controller\AdminController:signin');

// $app->get('/admin', '\App\Controller\AdminController:admin');

// $app->get('/logout', '\App\Controller\AdminController:logout');

// $app->post('/addCar', '\App\Controller\CollectionController:addCar');

// $app->post('/changeCarVisibility', '\App\Controller\CollectionController:changeCarVisibility');


