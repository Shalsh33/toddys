<?php

require_once 'app/controller/admin.controller.php';
require_once 'app/controller/index.controller.php';


// defino la base url para la construccion de links con urls semánticas
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index'; // acción por defecto si no envían
}

// parsea la accion Ej: suma/1/2 --> ['suma', 1, 2]
$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'admin':
		case_admin($params);
		break;
	case 'index':
		$controller = new index_controller();
		$controller->init();
		break;
    default:
        echo('404 Page not found');
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
							(!empty($params[3])) ? $controller->send_edit_comision($params[3]) : $controller->send_edit_comision(null);
							break;
							
						case 'delete':
							(!empty($params[3])) ? $controller->delete_persona($params[3]) : $controller->delete_persona(null);
							break;
							
						case 'add':
							$controller->add_persona();
							break;
							
						case 'send':
							$controller->send_form_persona();
							break;
							
						default:
							echo("Acción no reconocida.");
							
					}
				}
				break;
			case 'comisiones':
			 if (empty($params[2])){
				 $controller->list_comisiones();
			 } else {
				 switch($params[3]){
					 case 'edit':
						(!empty($params[3])) ? $controller->edit_comision($params[3]) : $controller->edit_comision(null); 
							//interfaz de edición (necesito un 3er párametro, si no está seteado, null)
							break;
						
						case 'update':
							(!empty($params[3])) ? $controller->send_edit_comision($params[3]) : $controller->send_edit_comision(null);
							break;
							
						case 'delete':
							(!empty($params[3])) ? $controller->delete_comision($params[3]) : $controller->delete_comision(null);
							break;
							
						case 'add':
							$controller->add_comision();
							break;
							
						case 'send':
							$controller->send_form_comision();
							break;
							
						default:
							echo("Acción no reconocida.");
							
					}
				 }
		}
	}
	
	
}