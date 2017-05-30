<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('acta');
		$this->load->model('tablaTotales');
		// $this->load->database();

	}

	// Este metodo, Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}

	public function index(){
		$data['data']['titulo'] = 'tfa';
		$data['contenido'] = 'menu/index';
		$this->load->view('layouts/plantilla',$data);
	}

	public function tablas(){
		$data['titulo']="";
		$this->load->view('menu/content',$data);
	}


	public function index2(){
		$data['data']['titulo'] = 'prueba';

		$this->load->view('menu/contenido',$data);

		$query= $this->db->query('select * from acta');
		print(json_encode($query->result()));
		// foreach ($query->result() as $row)
		// {
         //print($row->id);
         // echo $row->descripcion;

		// }
		// print(json_encode($query));
	}

	public function index3(){
		$data['data']['titulo'] = 'prueba';

		// $this->load->view('menu/home',$data);

		// $data['contenido'] = 'menu/home';
		$this->load->view('menu/home');
		// $this->load->view('layouts/plantilla',$data);

		// print(json_encode($this->acta->getid()));

	}

	public function traeractas()
	{
		// print($this->acta->getid());
		echo (json_encode($this->acta->getid()));
	}

	public function especies()
	{
		$r = $this->request();
		echo (json_encode($this->tablaTotales->getFullTable1($r["acta"]),JSON_NUMERIC_CHECK));
	}

	public function getTotales()
	{
		echo (json_encode($this->tablaTotales->getTotal(),JSON_NUMERIC_CHECK));
	}


	//localidades a las que se fue en la campana
	public function getLocalidadesxcamp()
	{
		// print($this->acta->getid());
		echo (json_encode($this->acta->getLocalidadesxcamp(1)));
	}


	//total de peces por localidad
	public function totalPorLoc()
	{
		$r = $this->request();
		// echo json_encode($r);
		echo (json_encode($this->acta->totalPorLoc($r["input"]),JSON_NUMERIC_CHECK));
	}

	public function getPorcentajes()
	{
			$r = $this->request();
			$localidades= $this->acta->getIndicesloc($r["acta"]);
			$tabla = $this->tablaTotales->getFullTable1($r["acta"]);
			$loc=[];


			for ($k=0; $k < (count($localidades)); $k++) {
                $loc[$k] = $this->acta->totalPorLoc($k+1);
            }
            $loc[$k]=$this->acta->totalPorLoc();
                // print (json_encode($loc));
            // print json_encode($loc[0]["total"]);
            // print json_encode($this->acta->getInciales(1)["iniciales"]);
            // print json_encode($tabla[0][$this->acta->getInciales(1)["iniciales"]]);
            // print json_encode($tabla);
			foreach ($tabla as $key => $v) {
				for ($k=0; $k < (count($localidades))+1; $k++) {
					if ($k < count($localidades) )
                	{
						$tabla[$key][$this->acta->getInciales($k+1)["iniciales"]]=$v[$this->acta->getInciales($k+1)["iniciales"]] / $loc[$k]["total"];
					}
					else
					{
						$tabla[$key]["total"]=$v["total"] / $loc[$k]["total"];
					}


					// print $v[$this->acta->getInciales($k+1)["iniciales"]];
					// print $loc[$k];
					// $v[$this->acta->getInciales($k+1)] = $tabla[$key][$this->acta->getInciales($k+1)] / $loc[$k];

				}
			}
			echo json_encode($tabla,JSON_NUMERIC_CHECK);


	}
}
