<?php

require_once "app/controller/controller.php";
require_once "app/Model/model.personas.php";
require_once "app/Model/model.comisiones.php";
require_once "app/View/admin.view.php";

class admin_controller extends controller{

	protected $model_personas;
	protected $model_comisiones;
	protected $model_relaciones;
	protected $view;

	function __construct(){
		
		$this->check_session();
		$this->view = new admin_view(true, $this->username());
		$this->model_personas = new model_personas();
		$this->model_comisiones = new model_comisiones();
		$this->model_relaciones = new model_relaciones();
		
		
	}
	
	function check_session(){
		
		
		if (! ($this->sesion()) ){
			header('location: ' . BASE_URL . 'login');
			die();
		}
		
	}
	
	function check_permissions($nivel){
		
		switch ($nivel){
			
			case 1:
				return ($_SESSION['permissions'] == "admin" || $_SESSION['permissions'] == "super admin");
				break;
			case 2:
				return ($_SESSION['permissions'] == "super admin");
				break;
			default:
				return false;
				break;
			
		}
		
	}
	
	function init(){
		$this->view->main_page();
	}
	
	private function set_status($array_ppal,$array_sec){
		
		foreach($array_sec as $selected){
			
			foreach($array_ppal as $item){
				
				if ($selected->id == $item ->id){
					
					$item->selected = true;
					break;

				} 
				
			}
			
		}
		
		
	}
	
	
	/*Acciones personas*/
	
	function list_personas(){
		
		if ($this->model_personas->check_connection()){
			$array_db = $this->model_personas->get_all();
			$this->view->admin_personas($array_db);
		} else {
			$this->view->connection_error();
		}
	}
	
	function edit_persona($id){
		
		$persona = ($id) ? $this->model_personas->get_one($id) : null;
		
		if ($persona) {
			$comisiones = $this->model_comisiones->get_all();
			$relaciones = $this->model_relaciones->get_relaciones_persona($id);
			$this->set_status($comisiones,$relaciones);
			$this->view->edit_persona($persona,$comisiones); 		
		} else {
			$this->view->error_param();
		}
	}
	
	function send_edit_persona() {
		
		$id = $_POST['id'];
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
	
	function add_persona(){
		
		$comisiones = $this->model_comisiones->get_all();
		$this->view->form_alta_persona($comisiones);
		
	}
	
	function send_form_persona(){
		
		if (isset($_POST['nombre']) && isset($_POST['periodo'])){
			$nombre = $_POST['nombre'];
			$periodo = $_POST['periodo'];
		} else {
			$this->view->error_param();
			die;
		}
			
		$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : null;
		$presidente = (isset($_POST['presidente']));
		$foto = (isset($_POST['foto'])) ? $_POST['foto'] : null;
		
		$this->model_personas->insert_persona($nombre,$periodo,$descripcion,$presidente,$foto); 
		$this->view->change_ready();
		
	}
	
	function delete_persona($id){
		
		$persona = $this->model_personas->get_one($id);
		
		$this->view->confirm_delete($persona);
		
	}
	
	function confirm_delete_persona(){
		
		$result = ($_POST['id']) ? $this->model_personas->delete_persona($_POST['id']) : null;
		
		($result) ? $this->view->action_done() : $this->view->error_param();
		
		//header("Location:admin/personas");
		
	}

	/*comisiones*/

	function list_comisiones(){
		
		if ($this->model_comisiones->check_connection()){
			$array_db = $this->model_comisiones->get_all();
			$this->view->admin_comisiones($array_db);
		} else {
			$this->view->connection_error();
		}
		
	}
	
	function edit_comision($id){
		
		($id) ? $info = $this->model_comisiones->get_one($id) : $info = null;
		
		($info) ? $this->view->edit_comision($info) : $this->view->error_param();
	}
	
	function send_edit_comision() {
		
		$id = $_POST['id'];
		$comision = array(
			"nombre" => $_POST['nombre'],
			"fecha" => $_POST['fecha']
		);
		
		$update = $this->model_comisiones->edit($id,$comision);
		
		($update) ? $this->view->action_done() : $this->view->error_param();
		
	}
	
	function add_comision(){
		
		$this->view->form_alta_comision();
		
	}
	
	function send_form_comision(){
		
		if (isset($_POST['nombre']) && isset($_POST['fecha'])){
			$nombre = $_POST['nombre'];
			$fecha = $_POST['fecha'];
		} else {
			$this->view->error_param();
			die;
		}
			
		
		$this->model_comisiones->insert_comision($nombre,$fecha); 
		$this->view->change_ready();
		
	}
	
	function delete_comision($id){
		
		$comision = $this->model_comisiones->get_one($id);
		
		$this->view->confirm_delete_comision($comision);
		
	}
	
	function confirm_delete_comision(){
		
		$result = ($_POST['id']) ? $this->model_comisiones->delete_comision($_POST['id']) : null;
		
		($result) ? $this->view->action_done() : $this->view->error_param();
		
		//header("Location:admin/comisiones");	
	}
	
	/*Usuarios*/
	
	//Se necesitan permisos nivel 2 o superior
	function list_users(){
		
		if ($this->check_permissions(2)){
			
			if ($this->model_users->check_connection()){
				$array_db = $this->model_users->get();
				$this->view->admin_users($array_db);
			} else {
				$this->view->connection_error();
			}
			
		} else {
			
			header("location: admin");
			
		}
		
		
		
	}
	
	function delete_user($id){
		
		$persona = $this->model_personas->get_one($id);
		
		$this->view->confirm_delete($persona);
		
	}
	
	function confirm_delete_user(){
		
		$result = ($_POST['id']) ? $this->model_personas->delete_persona($_POST['id']) : null;
		
		($result) ? $this->view->action_done() : $this->view->error_param();
		
		//header("Location:admin/users");
		
	}
	
	function change_permissions(){
		
		//desarrollar
		
	}
	
	/*Relaciones*/
	
	function admin_relaciones(){
		
		
		
	}
	
}