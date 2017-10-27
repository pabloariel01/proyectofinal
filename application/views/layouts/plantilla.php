<?php
	$this->load->view('layouts/header',$data);//$data tiene que ser un array, con lo que se le pase a las vistas!
	// $sidebar;
	$this->load->view('layouts/sidebar');
	$this->load->view($contenido);//Es el contenido de las vistas!
	//$this->load->view('menu/contenido');
	$data1['data']['abm'] = 'false';
	$this->load->view('layouts/footer',$data1);
?>
