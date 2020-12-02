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
$router->addRoute('admin/imagenes/:id/:action','POST','images_controller','init');
//Ruteo
$router->route($_GET["action"], $_SERVER['REQUEST_METHOD']);


/*
// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'inicio'; // acción por defecto si no envían
}

// parsea la accion Ej: suma/1/2 --> ['suma', 1, 2]
$params = explode('/', $action);

// determina que camino seguir según la acción
function case_admin ($params){
	$controller = new admin_controller();
	
	if (empty($params[1])){ //si no tengo más parámetros
		$controller->init(); //inicio la página
	} else{
		
		switch($params[1]){ //sino, veo a que tabla se quiere acceder
		
			case 'personas':
				if(empty($params[2])){ //Si no tengo otro parámetro,
					$controller->list_personas();//listo los elementos en la tabla persona
				} 
				else{
					switch($params[2]){ //sino, vamos a analizar la acción
						case 'edit': 
							(!empty($params[3])) ? $controller->edit_persona($params[3]) : $controller->edit_persona(null); 
							//interfaz de edición (necesito un 3er párametro, si no está seteado, null)
							break;
						
						case 'update':
							$controller->send_edit_persona();
							break;
							
						case 'delete':
							(!empty($params[3])) ? $controller->delete_persona($params[3]) : $controller->delete_persona(null);
							break;
							
						case 'elim':
							$controller->confirm_delete_persona();
							break;
							
						case 'send':
							$controller->send_form_persona();
							break;
							
						default:
							echo("Acción no reconocida.");
							header('refresh:2;url=admin/personas');
							
					}
				}
				break;
			case 'comisiones':
				if (empty($params[2])){
					$controller->list_comisiones();
				} else {
				 switch($params[2]){
					case 'edit':
						(!empty($params[3])) ? $controller->edit_comision($params[3]) : $controller->edit_comision(null); 
							//interfaz de edición (necesito un 3er párametro, si no está seteado, null)
						break;
						
					case 'update':
						$controller->send_edit_comision();
						break;
						
					case 'delete':
						(!empty($params[3])) ? $controller->delete_comision($params[3]) : $controller->delete_comision(null);
						break;
					
					case 'elim':
						$controller->confirm_delete_comision();
						break;
					
					case 'send':
						$controller->send_form_comision();
						break;
						
					default:
						echo("Acción no reconocida.");
						header('refresh:2;url=admin/comisiones');
							
					}
				 }
				break;
			case 'users':
				if (empty($params[2])){
					$controller->list_users();
				} else {
					switch ($params[2]){
						case 'delete':
							(!empty($params[3])) ? $controller->delete_user($params[3]) : $controller->delete_user(null);
							break;
						case 'elim':
							$controller->confirm_delete_user();
							break;
						case 'permissions':
							(!empty($params[3])) ? $controller->change_permissions($params[3]) : $controller->change_permissions(null);
							break;
						case 'update':
							$controller->set_permissions();
							break;
						default:
							echo("Acción no reconocida.");
							header('refresh:2;url=admin/users');
					}
				}
				break;
			default:
				echo("Acción no reconocida.");
				header('refresh:2;url=admin');
		}
	}
	
	
}*/