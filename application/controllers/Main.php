<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
function __construct()
{
        parent::__construct();
 
/* Standard Libraries of codeigniter are required */
$this->load->database();
$this->load->helper('url');
/* ------------------ */ 
 
$this->load->library('grocery_CRUD');
 
}
 
public function index()
{
echo "<h1>Welcome to the world of Codeigniter</h1>";
die();
}


public function employees()
{

$crud = new grocery_CRUD();

// $crud->set_theme('datatables');
$crud->set_subject('Acta');
$crud->set_table('acta');
$crud->columns('descripcion');
$crud->fields('descripcion');
$crud->display_as('descripcion','Descripcion');
$output = $crud->render();
 
$this->_example_output($output);        
}
 
function _example_output($output = null)
 
{
$this->load->view('crud_acta.php',$output);    
}
}