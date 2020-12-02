<?php

require_once 'app/controller/admin.controller.php';
require_once 'app/controller/index.controller.php';
require_once 'app/controller/auth.controller.php';
require_once 'app/controller/images.controller.php';
require_once 'libs/Router.php';


// defino la base url para la construccion de links con urls semánticas
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

//Creo el Router
$router = new Router();

//Asigno las acciones
//Acción por defecto
$router->setDefaultRoute('index_controller','inicio');
//Acciones del Index público
$router->addRoute('inicio','GET','index_controller','inicio');
$router->addRoute('personas','GET','index_controller','personas');
$router->addRoute('personas/:id','GET','index_controller','personas');
$router->addRoute('comisiones','GET','index_controller','comisiones');
//Acciones de Auth
$router->addRoute('login','GET','auth_controller','init');
$router->addRoute('login','POST','auth_controller','login');
$router->addRoute('registro','GET','auth_controller','alta_user');
$router->addRoute('registro','POST','auth_controller','send_form');
$router->addRoute('logout','GET','auth_controller','logout');
//Funciones del Admin
$router->addRoute('admin','GET','admin_controller','init');
$router->addRoute('admin/:table','GET','admin_controller','admin');
$router->addRoute('admin/:table','POST','admin_controller','adminAdd');
$router->addRoute('admin/:table/:id','GET','admin_controller','abmAdmin');
$router->addRoute('admin/:table/:id/:action','POST','admin_controller','sendForm');
//Imagenes
$router->addRoute('imagenes/:id/:action','POST','images_controller','init');
//Ruteo
$router->route($_GET["action"], $_SERVER['REQUEST_METHOD']);
