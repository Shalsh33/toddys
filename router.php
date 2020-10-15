<?php

require_once 'app/controller/admin.controller.php';
require_once 'app/controller/index.controller.php';
require_once 'app/controller/auth.controller.php';


// defino la base url para la construccion de links con urls semánticas
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'inicio'; // acción por defecto si no envían
}

// parsea la accion Ej: suma/1/2 --> ['suma', 1, 2]
$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {
	case 'login':
		$controller = new auth_controller();
		if (empty($params[1])){
			$controller->init();
		} else {
			$controller->login();
		}
		break;
	case 'registro':
		$controller = new auth_controller();
		if (empty($params[1])){
			$controller->alta_user();
		} else {
			$controller->send_form();
		}
		break;
	case 'logout':
		$controller = new auth_controller();
		$controller->logout();
		break;
    case 'admin':
		case_admin($params);
		break;
	case 'inicio':
		$controller = new index_controller();
		$controller->personas();
		break;
	case 'comisiones':
		$controller = new index_controller();
		$controller->comisiones();
		break;
    default:
        echo('404 Page not found');
		header('refresh:2;url=inicio');
        break;
}

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
						case 'send':
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
	
	
}