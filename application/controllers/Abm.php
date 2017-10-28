<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Abm extends CI_Controller {

function __construct(){
        parent::__construct();

/* Standard Libraries of codeigniter are required */

$this->load->helper('url');
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
  // $this->load->view('crud_acta.php',$output);
}


public function actas(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Acta');
    $crud->set_table('acta');
    $crud->columns('descripcion');
    $crud->fields('descripcion');
    $crud->display_as('descripcion','Descripcion');
    $crud->set_rules('descripcion', 'Descripcion', 'required');
    $crud->set_rules('descripcion','Descripcion','integer');
    $output = $crud->render();

    $this->_example_output($output);
}


public function campania(){

    $crud = new grocery_CRUD();

    $crud->set_subject('`campaña`');
    $crud->set_table('campaña');
    $crud->columns('idcampaña','mes','año','acta_id');
    $crud->display_as('idcampaña','id');
    $crud->set_relation('acta_id','acta','descripcion');
    $crud->display_as('descripcion','Descripcion');
    $crud->display_as('acta_id','Nro. Acta');
    $crud->set_rules('año','año','integer');
    $crud->field_type('mes','enum',array(1,2,3,4,5,6,7,8,9,10,11,12));
    $crud->set_rules('año', 'Año', 'required');
    $crud->set_rules('mes', 'Mes', 'required');
    $crud->set_rules('acta_id', 'Nro. Acta', 'required');
    $output = $crud->render();

    $this->_example_output($output);
}

public function camploc(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('`campaña-localidad`');
    $crud->set_table('campaña-localidad');
    $crud->columns('id','idcampaña','localidad_id','oxigenodisuelto','oxigenoporcent','tempagua','id_acta','tempaire','ph','turbidad','condictividad');


    $crud->set_relation('id_acta','acta','descripcion');
    $crud->set_relation('localidad_id','localidad','nombre');
    $crud->field_type('idcampaña','enum',array(1,2,3,4,5,6,7,8,9,10,11,12));
    $crud->display_as('id_acta','Nro. Acta');
    $crud->display_as('localidad_id','localidad');
    $crud->display_as('idcampaña','Nro. campaña');

    $crud->set_rules('tempagua', 'tempagua', 'numeric|trim');
    $crud->set_rules('tempaire', 'tempaire', 'numeric|trim');
    $crud->set_rules('ph', 'ph', 'numeric|trim');
    $crud->set_rules('turbidad', 'turbidad', 'numeric|trim|required');
    $crud->set_rules('condictividad', 'condictividad', 'numeric|trim');
    $crud->set_rules('oxigenodisuelto ', 'Oxigenodisuelto ', 'numeric|trim');
    $crud->set_rules('oxigenoporcent ', 'Oxigenoporcent ', 'numeric|trim');
    $crud->set_rules('idcampaña', 'idcampaña', 'numeric|trim');
    $crud->set_rules('localidad_id', 'localidad_id', 'numeric|trim');
    $crud->set_rules('id_acta', 'Nro. Acta', 'required');
    $crud->set_rules('idcampaña','Nro. campaña', 'required');
    $crud->set_rules('localidad_id','localidad', 'required');
    $output = $crud->render();

    $this->_example_output($output);
}


public function localidad(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('`localidad`');
    $crud->set_table('localidad');
    $crud->columns('nombre','iniciales');
    $crud->set_rules('nombre', 'nombre', 'trim|required|alpha');
    $crud->set_rules('iniciales', 'iniciales', 'trim|required|alpha');
    $output = $crud->render();

    $this->_example_output($output);
}

public function red(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('`Redes`');
    $crud->set_table('red');
    $crud->columns('id','abertura','longitud','altura','mallaspormetro','tamaño');
    $crud->set_rules('abertura ', 'abertura ', 'numeric|trim');
    $crud->set_rules('longitud ', 'longitud ', 'numeric|trim');
    $crud->set_rules('altura ', 'altura ', 'numeric|trim');
    $crud->set_rules('altura ', 'altura ', 'numeric|trim');
    $crud->set_rules('mallaspormetro ', 'mallaspormetro ', 'numeric|trim');
    $output = $crud->render();

    $this->_example_output($output);
}

public function fondo(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Fondo');
    $crud->set_table('fondo');
    $crud->columns('descripcion');
    $crud->set_rules('descripcion', 'descripcion', 'trim|required|alpha');
    $output = $crud->render();

    $this->_example_output($output);
}

public function especie(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Especies');
    $crud->set_table('especie');
    $crud->columns('descripcion');
    $crud->set_rules('descripcion', 'descripcion', 'trim|required|alpha');
    $output = $crud->render();

    $this->_example_output($output);
}

public function pesca(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Pesca');
    $crud->set_table('pesca');
    $crud->columns('campaña-localidad_id','red_id','fondo_idfondo','profundidad','velcorriente','fecha','artescomp','duracionlance','horainicio','horafin','mininicio','minfin','mes','coeficiente');

    $crud->set_relation('campaña-localidad_id','`campaña-localidad`','id');
    $crud->set_relation('fondo_idfondo','fondo','idfondo');
    $crud->set_relation('red_id','`red`','`id`');

    $crud->display_as('red_id','Nro. Red');
    $crud->display_as('campaña-localidad_id','Nro. campaña');
    $crud->display_as('fondo_idfondo','Tipo de Fondo');

    $crud->set_rules('secchi', 'secchi', 'numeric|trim');
    $crud->set_rules('profundidad', 'profundida', 'numeric|trim');
    $crud->set_rules('velcorriente', 'Velcorriente', 'numeric|trim');
    $crud->field_type('artescomp','enum',array('Batería de Redes','Artes Complementarias'));
    $crud->field_type('mes','enum',array(1,2,3,4,5,6,7,8,9,10,11,12));
    // $crud->set_rules('artescomp', 'artescomp','required');
    $crud->set_rules('horafin', 'horafin', 'numeric|trim');
    $crud->set_rules('horainicio', 'horainicio', 'numeric|trim');
    $crud->set_rules('minfin', 'minfin', 'numeric|trim');
    $crud->set_rules('mininicio', 'mininicio', 'numeric|trim');
    $crud->set_rules('duracionlance', 'duracionlance', 'numeric|trim');
    $crud->fields('secchi','campaña-localidad_id','red_id','fondo_idfondo','profundidad','velcorriente','fecha','artescomp','horainicio','horafin','mininicio','minfin','mes','coeficiente');

    $crud->required_fields('campaña-localidad_id','red_id','artescomp','fecha','mes','horafin','horainicio','minfin','mininicio');
    $output = $crud->render();

    $this->_example_output($output);
}


public function otolito(){

    $crud = new grocery_CRUD();

    // $crud->set_theme('datatables');
    $crud->set_subject('Otolitos');
    $crud->set_table('otolito');
    $crud->columns('pescado_id','roto','lado','edad','longitud','peso');
    $crud->field_type('roto','enum',array(1));
    $crud->field_type('lado','enum',array('I','D'));
    $crud->required_fields('lado','pescado_id');
    $crud->set_rules('edad', 'edad', 'numeric|trim|less_than[99]');
    $crud->set_rules('longitud', 'longitud', 'numeric|trim');
    $crud->set_rules('peso', 'peso', 'numeric|trim');
    // $crud->fields('descripcion');
    $crud->display_as('pescado_id','Nro. Pescado');


    $crud->set_relation('pescado_id','pescado','id');



    // $crud->required_fields()
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
    $crud->columns('id','especie_id','sexo_id','pesohigado','grasa','colorhigado','muestrahigado','ph','pesoriñon','pesogonada','muestragonada','parasito','descripcion','nroorden','gonada_id','peso','altura','largo','pesca_id','mutilado','pesoest','largoest');
    // $crud->fields('descripcion');
    // $crud->display_as('idcampaña','id');
    $crud->fields('especie_id','sexo_id','pesohigado','grasa','colorhigado','muestrahigado','ph','pesoriñon','pesogonada','muestragonada','parasito','descripcion','nroorden','gonada_id','peso','altura','largo','pesca_id','mutilado');
    $crud->set_relation('pesca_id','pesca','id');
    $crud->set_relation('especie_id','especie','descripcion');
    $crud->set_relation('sexo_id','sexo','descripcion');
    $crud->set_relation('gonada_id','gonada','descripcion');

    $crud->required_fields('especie_id','sexo_id','gonada_id','pesca_id');

    $crud->set_rules('pesohigado', 'pesohigado', 'numeric|trim');
    $crud->set_rules('grasa', 'grasa', 'numeric|trim');
    $crud->set_rules('muestrahigado', 'muestrahigado', 'numeric|trim');
    $crud->set_rules('ph', 'ph', 'numeric|trim');
    $crud->set_rules('colorhigado', 'colorhigado', 'numeric|trim');
    $crud->set_rules('pesoriñon', 'pesoriñon', 'numeric|trim');
    $crud->set_rules('pesogonada', 'pesogonada', 'numeric|trim');
    $crud->set_rules('muestragonada', 'muestragonada', 'numeric|trim');
    $crud->set_rules('pesoriñon', 'pesoriñon', 'numeric|trim');
    $crud->set_rules('nroorden', 'nroorden', 'numeric|trim');
    $crud->set_rules('peso', 'peso', 'numeric|trim');
    $crud->set_rules('altura', 'altura', 'numeric|trim');
    $crud->set_rules('largo', 'largo', 'numeric|trim');
    $crud->set_rules('mutilado', 'mutilado', 'numeric|trim');
    $crud->set_rules('parasito', 'parasito', 'alpha-numeric|trim');
    $crud->set_rules('descripcion', 'descripcion', 'alpha-numeric|trim');

    // $crud->display_as('red_id','Nro. Red');
    // $crud->display_as('`campaña-localidad_id`','Nro. campaña');
    // $crud->display_as('fondo_idfondo','Tipo de Fondo');
    $output = $crud->render();

    $this->_example_output($output);
}



}
