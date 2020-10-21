<?php

require_once "app/controller/controller.php";
require_once "app/Model/model.personas.php";
require_once "app/Model/model.comisiones.php";
require_once "app/model/model.users.php";
require_once "app/View/admin.view.php";

class admin_controller extends controller{

	protected $model_personas;
	protected $model_comisiones;
	protected $model_relaciones;
	protected $model_users;
	protected $view;

	function __construct(){
		
		$this->check_session();
		$this->view = new admin_view(true, $this->username());
		$this->model_personas = new model_personas();
		$this->model_comisiones = new model_comisiones();
		$this->model_relaciones = new model_relaciones();
		$this->model_users = new model_users();
		if (! ($this->model_comisiones->check_connection() && $this->model_personas->check_connection() && $this->model_relaciones->check_connection())){
			$this->view->connection_error();
			header('refresh:5;url='.BASE_URL.'inicio');
		}
	}
	
	
	private function check_session(){ //comprueba que exista una sesión
		
		
		if (! ($this->sesion()) ){
			header('location:' . BASE_URL . 'login');
			die();
		}
		
	}
	
	private function check_permissions($table){ //comprueba el nivel de permisos para las áreas del admin
		
		switch ($table){
			case 'personas':
			case 'comisiones':
				$permissions = ($_SESSION['permissions'] == "admin" || $_SESSION['permissions'] == "super admin");
				break;
			case 'users':
				$permissions = ($_SESSION['permissions'] == "super admin");
				break;
			default:
				$permissions = false;
				break;
			
		}
		
		if(! $permissions){
			
			$this->view->denied();die;
			
		}
		
	}
	
	
	private function set_status($array_ppal,$array_sec){ //Agrega un atributo a las personas que permite saber si son parte
															//de una comisión o a las comisiones, que permite saber si están asignadas a una persona.
		foreach($array_ppal as $item){
			
			$item->selected = false;
			
		}
		
		foreach($array_sec as $selected){
			
			foreach($array_ppal as $item){
				
				if ($selected->id == $item ->id){
					
					$item->selected = true;
					break;

				} 
				
			}
			
		}	
	}
	
	
/*Acciones de ruteo*/
	/*Página principal*/
	function init($params = null){
		$level = 0;
		switch($_SESSION['permissions']){
			case 'usuario':
				$level = 0;
				break;
			case 'admin':
				$level = 1;
				break;
			case 'super admin':
				$level = 2;
				break;
		}
		$this->view->main_page($level);
	}
	
	/*Acceso a los listados de tablas*/
	function admin($params = null){
		
		if ($params){
			$table = $params[':table'];
			$this->check_permissions($table);
			$action = "list_$table";
			$this->$action();
		} else {
			$this->init();
		}
		
	}
	
	/*Alta de personas/comisiones*/
	function adminAdd($params = null){
		
		if ($params){
			$table = $params[':table'];
			$this->check_permissions($table);
			$action = "alta_$table";
			$this->$action();
		} else {
			$this->init();
		}
		
	}
	
	/*Interfaz de edición*/
	function abmAdmin($params = null){
		
		if ($params){
			$table = $params[':table'];
			$this->check_permissions($table);
			$action = "edit_$table";
			$this->$action($params[':id']);
		} else {
			$this->init();
		}
		
	}
	
	/*Acciones de edit o delete*/
	function sendForm($params){
		
		if ($params){
			$table = $params[':table'];
			$this->check_permissions($table);
			$action = "send_".$params[':action']."_$table";
			$id = $params[':id'];
			$this->$action($id);
		} else{
			$this->view->error_param();
		}
		
	}
	
/*Acciones personas*/
	function list_personas(){
		
		$array_db = $this->model_personas->get_all();
		$this->view->admin_personas($array_db);
		
	}
	
	function edit_personas($id){
		
		$persona = ($id) ? $this->model_personas->get_one_extended($id) : null;
		
		if ($persona) {
			
			$comisiones = $this->model_comisiones->get_all();
			$relaciones = $this->model_relaciones->get_relaciones_persona($id);
			$this->set_status($comisiones,$relaciones);
			$this->view->edit_persona($persona,$comisiones); 
			
		} else {
			
			$this->view->error_param();
		
		}
	}
	
	function alta_personas(){
		
		if (isset($_POST['nombre']) && isset($_POST['periodo'])){
			$nombre = $_POST['nombre'];
			$periodo = $_POST['periodo'];
		} else {
			$this->view->error_param();
			die;
		}
			
		$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : null;
		$presidente = (isset($_POST['presidente']));
		$foto = (isset($_POST['foto'])) ? $_POST['foto'] : 'none.png';
		
		$add = $this->model_personas->insert($nombre,$periodo,$descripcion,$presidente,$foto); 
		($add) ? $this->view->action_done() : $this->view->error_param();
		$this->redirect("personas");
	}
	
	function send_edit_personas($id) {
		
		$presidente = (isset($_POST['presidente'])) ? true : false;
		$persona = array(
			"nombre" => $_POST['nombre'],
			"periodo" => $_POST['periodo'],
			"descripcion" => $_POST['descripcion'],
			"presidente" => $presidente,
			"foto" => $_POST['foto']
		);
		
		if (! $this->model_personas->equal($persona,$id)){
		
			$update = $this->model_personas->edit($id,$persona);
			if (!$update){
				$this->view->error_param(); die;
			}
		} 
		
		$comisiones = $_POST['comisiones'];
		
		$update = $this->model_relaciones->set_comisiones($comisiones,$id);
		
		($update) ? $this->view->action_done() : $this->view->error_param();
		
	}
		
	function send_delete_personas($id){
		
		$result = $this->model_personas->delete_persona($id);
		
		($result) ? $this->view->action_done() : $this->view->error_param();

	}

/*Comisiones*/
	function list_comisiones(){
		
		$array_db = $this->model_comisiones->get_all();
		$this->view->admin_comisiones($array_db);
		
	}
	/*Formulario de edit individual*/
	function edit_comisiones($id){
		
		 $comision = ($id) ? $this->model_comisiones->get_one($id) : null;
		
		if ($comision) {
			
			$personas = $this->model_personas->get_all();
			$relaciones = $this->model_relaciones->get_relaciones_comision($id);
			$this->set_status($personas,$relaciones);
			$this->view->edit_comision($comision,$personas); 
			
		} else {
			
			$this->view->error_param();
		
		}
		
	}
	/*Recibo de form para alta*/
	function alta_comisiones(){
		
		if (isset($_POST['nombre']) && isset($_POST['fecha'])){
			$nombre = $_POST['nombre'];
			$fecha = $_POST['fecha'];
		} else {
			$this->view->error_param();
			die;
		}
			
		
		$add = $this->model_comisiones->insert($nombre,$fecha); 
		($add) ? $this->view->action_done() : $this->view->error_param();
		
	}
	/*Recibo de form para edit individual*/
	function send_edit_comisiones($id) {
		
		//Se obtienen los datos del form
		$comision = array(
			"nombre" => $_POST['nombre'],
			"fecha" => $_POST['fecha']
		);
		
		//Primero controlamos si existe algún cambio en los datos
		if (! $this->model_comisiones->equal($comision,$id)){
			//Si se cambia algo, entonces la comisión se edita
			$update = $this->model_comisiones->edit($id,$comision);
			if (!$update) {
				$this->view->error_param(); 
				die;
			}

		}
		//Se obtiene el arreglo de personas que son parte de la comisión
		$personas = $_POST['personas'];
		//Se las agrega a la tabla persona_comision
		$update = $this->model_relaciones->set_personas($personas,$id);
		
		($update) ? $this->view->action_done() : $this->view->error_param();
		
		
	}
		
	function send_delete_comisiones($id){
		
		$result = $this->model_comisiones->delete_comision($id);
		
		($result) ? $this->view->action_done() : $this->view->error_param();
			
	}
	
/*Usuarios*/
	//Se necesitan permisos nivel 2 o superior
	function list_users(){
		
			
		$array_db = $this->model_users->get_all();
		$this->view->admin_users($array_db);
		
	}
	
	function edit_users($id){
		
		
		$user = $this->model_users->get_one($id);
		
		if ($user){ 
			$this->view->edit_user($user);
		} else {
			$this->view->error_param();
		}
		
	}
	//El alta de usuarios lo realiza el auth controller
	function send_edit_users($id){
		/*Setea los nuevos permisos del usuario*/
		$role = $_POST['role'];
		$result = $this->model_users->edit($id,$role);
		
		($result) ? $this->view->action_done() : $this->view->error_param();
		
	}
	
	function send_delete_users($id){
		
		$result = $this->model_users->delete_user($id);
		
		($result) ? $this->view->action_done() : $this->view->error_param();
		
	}
	
}