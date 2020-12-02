<?php

require_once "app/controller/controller.php";
require_once "app/Model/model.personas.php";
require_once "app/Model/model.comisiones.php";
require_once "app/model/model.users.php";
require_once "app/View/admin.view.php";
require_once 'app/controller/images.controller.php';

class admin_controller extends controller{

	protected $model_personas;
	protected $model_comisiones;
	protected $model_relaciones;
	protected $model_users;
	protected $view;
	protected $permissions;
	protected $images;

	function __construct(){
		
		$this->check_session();
		$this->view = new admin_view(true, $this->username());
		$this->model_personas = new model_personas();
		$this->model_comisiones = new model_comisiones();
		$this->model_relaciones = new model_relaciones();
		$this->model_users = new model_users();
		$this->images = new images_controller();
		if (! ($this->model_comisiones->check_connection() && $this->model_personas->check_connection() && $this->model_relaciones->check_connection())){
			$this->view->connection_error();
			header('refresh:5;url='.BASE_URL.'inicio');
		}
		$this->permissions = $this->permissionsLevel();
	}
	
	//comprueba que exista una sesión
	private function check_session(){ 
		if (! ($this->sesion()) ){ //parent::session(): boolean
			header('location:' . BASE_URL . 'login');
			die();
		}	
	}

	//comprueba el nivel de permisos para las áreas del admin
	private function check_permissions($table){ 
		
		switch ($table){
			case 'personas':
			case 'comisiones':
				$level = ($this->permissions > 0);
				break;
			case 'users':
				$level = ($this->permissions > 1);
				break;
			default:
				$level = false;
				break;
			
		}
		
		if(! $level){
			
			$this->view->denied();die;
			
		}
		
	}
	
	//Agrega un atributo a las personas que permite saber si son parte de una comisión o a las comisiones, que permite saber si están asignadas a una persona.
	private function set_status($array_ppal,$array_sec){

		foreach($array_ppal as $item){ //Recorro el array principal (Todos los elementos de la db)
			
			$item->selected = false; //A cada item se le agrega el atributo "selected" (default en false)
			
		}

		foreach($array_sec as $selected){ //luego del array secundario (los que realmente están asignados)
			
			foreach($array_ppal as $item){ //voy a comparar los elementos
				
				if ($selected->id == $item ->id){ //si coinciden 
					
					$item->selected = true; //Marco que la relación está establecida
					break; //Sigo con el siguiente elemento
							// Ver costo de ejecución. ¿Preferible ordenar los arr y usar búsqueda booleana?
				} 
				
			}
			
		}	
	}
	
	
/*Acciones de ruteo*/
	/*Página principal*/
	function init($params = null){
		$this->view->main_page($this->permissions);
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

/************************Funciones de cada tabla******************************/	
/* 
List: Muestra la lista de todas las tablas
Edit: Muestra la interfaz de edición/borrado de una persona en particular
Alta: Agrega un elemento a la db (Se llama desde el form del admin de c/tabla). En caso de usuarios el alta se hace via auth.controller
Send_action: Envía los forms de edición o borrado de un elemento en particular.
*/

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

		
		
		$add = $this->model_personas->insert($nombre,$periodo,$descripcion,$presidente); 

		$flags = $this->images->images_upload($add);
		

		$this->view->action_done($flags);
		
	}
	
	

	function send_edit_personas($id) {
		
		$presidente = (isset($_POST['presidente'])) ? true : false;
		$persona = array(
			"nombre" => $_POST['nombre'],
			"periodo" => $_POST['periodo'],
			"descripcion" => $_POST['descripcion'],
			"presidente" => $presidente,
		);
		
		if (! $this->model_personas->equal($persona,$id)){
		
			$update = $this->model_personas->edit($id,$persona);
			if (!$update){
				$this->view->error_param(); die;
			}
		} 
		
		$comisiones = $_POST['comisiones'];
		
		$update = $this->model_relaciones->set_comisiones($comisiones,$id);

		$flags = (empty($_FILES['foto']['nombre'])) ? false : $this->images->images_upload($id);

		($update) ? $this->view->action_done($flags) : $this->view->error_param();
		
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