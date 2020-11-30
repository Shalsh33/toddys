<?php

require_once 'app/api/comments.controller.php';
require_once 'libs/Router.php';


//Creo el Router
$router = new Router();

$router->setDefaultRoute('comments_controller','wrong_path');

//Asigno las acciones
$router->addRoute('comments/:persona','GET','comments_controller','getAll');
$router->addRoute('comments/:persona','POST','comments_controller','add');
$router->addRoute('comments/:persona','DELETE','comments_controller','deletePersonaComments');
$router->addRoute('comments/:user/:comment','PUT','comments_controller','edit');
$router->addRoute('comments/:user/:comment','DELETE','comments_controller','deleteComment');

//Ruteo
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);