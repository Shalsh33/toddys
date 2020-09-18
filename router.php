<?php
require_once 'app/controller/admin.controller.php';

// defino la base url para la construccion de links con urls semánticas
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'admin'; // acción por defecto si no envían
}

// parsea la accion Ej: suma/1/2 --> ['suma', 1, 2]
$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'admin':
		$controller = new admin_controller();
		if (empty($params[1])){
			$controller->init();
		}
		else{
			switch($params[1]){
				case 'personas':
					if(empty($params[2])){
						$controller->listar_personas();
					} else{
						switch($params[2]){
							case 'editar':
								$controller->editar_persona($params[3]);
								break;
							case 'update':
								$controller->enviar_edit($params[3]);
						}
					}
					break;
			}
		}
		break;
    default:
        echo('404 Page not found');
        break;
}
