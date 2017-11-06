<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Abmusuario extends Admin_Controller {

function __construct(){
        parent::__construct();

/* Standard Libraries of codeigniter are required */

$this->load->helper('url');
$this->load->helper('security');
/* ------------------ */
$this->load->library('grocery_CRUD');
}


function _example_output($output = null){
  $data['titulo'] = 'pfc';

  $this->load->view('layouts/header',$data);//$data tiene que ser un array, con lo que se le pase a las vistas!
	$this->load->view('layouts/sidebar');

  $this->load->view('crud_acta.php',$output);
  $data['abm'] = 'true';
  $this->load->view('layouts/footer');
  // $this->load->view('layouts/footerabm');

}

public function index()
{
echo "<h1>Welcome to the world of Codeigniter</h1>";
die();
}


public function usuarios($operation = null){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Usuarios');
    $crud->set_table('usuarios');
    $crud->columns('nombre','rol');
    $crud->fields('nombre','rol','password','passconf');
    $crud->set_relation('rol','roles','descripcion');
    $crud->required_fields('rol','nombre','password','passconf');
    $crud->change_field_type('password','password');
    $crud->change_field_type('passconf','password');

    $crud->set_rules('password','Password','required|trim|min_length[6]|matches[passconf]');
    $crud->set_rules('passconf','Password','required|trim|min_length[6]');

    if( $operation == 'insert_validation' || $operation == 'insert'){

      $crud->set_rules('nombre', 'Nombre', 'required|trim|is_unique[usuarios.nombre]');
    }else{
      $crud->set_rules('nombre', 'Nombre', 'required|trim');
      $crud->unset_edit_fields('nombre','rol','password','passconf');
    }

    // var_dump($this);
    $crud->callback_before_insert(array($this,'encrypt_password_callback'));
    $crud->callback_before_update(array($this,'encrypt_password_callback'));
    $output = $crud->render();
    $this->_example_output($output);
}

function encrypt_password_callback($post_array){
  // var_dump($this);
  // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
  // var_dump($post_array);
   unset($post_array['passconf']);
  $post_array['password'] = password_hash($post_array['password'], PASSWORD_BCRYPT);
  // var_dump($post_array);

  return $post_array;
}

}
