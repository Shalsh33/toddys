<?php

require_once 'app/api/comments.controller.php';
require_once 'app/api/star.controller.php';
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

//Para las calificaciones
$router->addRoute('calificacion/:persona','GET','star_controller','getAVG');
$router->addRoute('calificacion/:persona','POST','star_controller','add');
$router->addRoute('calificacion/:persona/:user','GET','star_controller','get');

//Ruteo
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);