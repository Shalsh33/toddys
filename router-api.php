<?php

require_once 'app/api/comments.controller.php';
require_once 'libs/Router.php';


//Creo el Router
$router = new Router();

$router->setDefaultRoute('comments_controller','wrong_path');

//Asigno las acciones
$router->addRoute('comments','GET','comments_controller','getAll');
$router->addRoute('comments/:user','GET','comments_controller','getGroup');
$router->addRoute('comments/:user','POST','comments_controller','add');
$router->addRoute('comments/:user','DELETE','comments_controller','deleteUserComments');
$router->addRoute('comments/:user/:comment','GET','comments_controller','getOne');
$router->addRoute('comments/:user/:comment','PUT','comments_controller','edit');
$router->addRoute('comments/:user/:comment','DELETE','comments_controller','deleteComment');

//Ruteo
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
