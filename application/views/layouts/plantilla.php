<?php
	$this->load->view('layouts/header',$data);//$data tiene que ser un array, con lo que se le pase a las vistas!
	
	$this->load->view($contenido);//Es el contenido de las vistas!
	//$this->load->view('menu/contenido');
	$this->load->view('layouts/footer');
?>
