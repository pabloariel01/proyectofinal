<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vistas extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('functions');
		// $this->load->database();

	}

	// Este metodo, Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}

	public function index(){
		$data['data']['titulo'] = 'pfc';
		$data['contenido'] = 'menu/index';
		$this->load->view('layouts/plantilla',$data);
	}


	public function resumenCapturas(){
		$data['data']['titulo'] = 'pfc';

		$this->load->view('menu/resumenCapturas');

	}

}
