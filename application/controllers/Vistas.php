<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vistas extends Member_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('functions');
		// $this->load->database();

	}

	//Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}
//carga controlador angular
	public function index(){
		$data['data']['titulo'] = 'pfc';
		$data['contenido'] = 'menu/index';

		$this->load->view('layouts/plantilla',$data);
	}
//carga navbar y sidebar



	public function resumenCapturas(){
		$data['data']['titulo'] = 'pfc';
		// $this->load->view('layouts/sidebar');
		$this->load->view('menu/resumenCapturas');
	}

	public function totalypesoporloc(){
		$data['data']['titulo'] = 'pfc';
		// $this->load->view('layouts/sidebar');
		$this->load->view('menu/totalypesoporloc');
	}

	public function sumcpueloc(){
		$data['data']['titulo'] = 'pfc';
		// $this->load->view('layouts/sidebar');
		$this->load->view('menu/totalypesoporloc');
	}
}
