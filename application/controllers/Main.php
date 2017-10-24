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


public function actas(){

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

function _example_output($output = null){

  $this->load->view('crud_acta.php',$output);
}


public function campania(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('`campaña`');
    $crud->set_table('campaña');
    $crud->columns('idcampaña','mes','año','acta_id');
    // $crud->fields('descripcion');
    $crud->display_as('idcampaña','id');
    $crud->set_relation('acta_id','acta','descripcion');
    $crud->display_as('descripcion','Descripcion');
    $output = $crud->render();

    $this->_example_output($output);
}

public function camploc(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('`campaña-localidad`');
    $crud->set_table('campaña-localidad');
    $crud->columns('id','idcampaña','localidad_id','tempagua','id_acta','tempaire','ph','turbidad','condictividad');
    // $crud->fields('descripcion');
    // $crud->display_as('idcampaña','id');

    $crud->set_relation('id_acta','acta','descripcion');
    $crud->set_relation('localidad_id','localidad','nombre');
    // $crud->set_relation('idcampaña','`campaña`','`idcampaña`');
    $crud->display_as('id_acta','Nro. Acta');
    $crud->display_as('localidad_id','localidad');
    $crud->display_as('idcampaña','Nro. campaña');
    $output = $crud->render();

    $this->_example_output($output);
}


public function localidad(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('`localidad`');
    $crud->set_table('localidad');
    $crud->columns('nombre','iniciales');
    $output = $crud->render();

    $this->_example_output($output);
}

public function red(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('`Redes`');
    $crud->set_table('red');
    $crud->columns('id','abertura','longitud','altura','mallaspormetro','tamaño');
    $output = $crud->render();

    $this->_example_output($output);
}

public function fondo(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Fondo');
    $crud->set_table('fondo');
    $crud->columns('descripcion');
    $output = $crud->render();

    $this->_example_output($output);
}

public function especie(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Especies');
    $crud->set_table('especie');
    $crud->columns('descripcion');
    $output = $crud->render();

    $this->_example_output($output);
}

public function pesca(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Pesca');
    $crud->set_table('pesca');
    $crud->columns('`campaña-localidad_id`','red_id','fondo_idfondo','profundidad','velcorriente','fecha','artescomp','duracionlance','horainicio','horafin','mininicio','minfin','mes','coeficiente');
    // $crud->fields('descripcion');
    // $crud->display_as('idcampaña','id');

    $crud->set_relation('`campaña-localidad_id`','`campaña-localidad`','id');
    $crud->set_relation('fondo_idfondo','fondo','idfondo');
    $crud->set_relation('red_id','`red`','`id`');
    $crud->display_as('red_id','Nro. Red');
    $crud->display_as('`campaña-localidad_id`','Nro. campaña');
    $crud->display_as('fondo_idfondo','Tipo de Fondo');
    $output = $crud->render();

    $this->_example_output($output);
}


public function otolito(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Otolitos');
    $crud->set_table('otolito');
    $crud->columns('`campaña-localidad_id`','pescado_id','pesca_id','pesca_mes','roto','lado','edad','longitud','peso');
    // $crud->fields('descripcion');
    // $crud->display_as('idcampaña','id');

    $crud->set_relation('`campaña-localidad_id`','`campaña-localidad`','id');
    $crud->set_relation('pescado_id','pescado','id');
    $crud->set_relation('pesca_id','pescado','pesca_id');
    $crud->set_relation('pesca_mes','pescado','pesca_mes');
    // $crud->display_as('red_id','Nro. Red');
    // $crud->display_as('`campaña-localidad_id`','Nro. campaña');
    // $crud->display_as('fondo_idfondo','Tipo de Fondo');
    $output = $crud->render();

    $this->_example_output($output);
}

public function pescado(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Pescado');
    $crud->set_table('pescado');
    $crud->columns('id','`campaña-localidad_id`','sexo_id','pesohigado','grasa','colorhigado','muestrahigado','ph','pesoriñon','pesogonada','muestragonada','parasito','descripcion','nroorden','gonada_id','peso','altura','largo','especie_id','pesca_id','pesca_mes','mutilado','pesoest','largoest');
    // $crud->fields('descripcion');
    // $crud->display_as('idcampaña','id');

    $crud->set_relation('`campaña-localidad_id`','pesca','id');
    $crud->set_relation('pesca_id','pesca','id');
    $crud->set_relation('pesca_mes','pesca','mes');
    $crud->set_relation('especie_id','especie','descripcion');
    $crud->set_relation('sexo_id','sexo','descripcion');
    $crud->set_relation('gonada_id','gonada','descripcion');
    // $crud->display_as('red_id','Nro. Red');
    // $crud->display_as('`campaña-localidad_id`','Nro. campaña');
    // $crud->display_as('fondo_idfondo','Tipo de Fondo');
    $output = $crud->render();

    $this->_example_output($output);
}



}
