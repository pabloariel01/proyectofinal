<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Member_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('acta');
		$this->load->model('tablaTotales');
		$this->load->model('functions');
		// $this->load->database();

	}

	// Este metodo, Descodifica el array que esta en JSON... para trabajar con php
	public function request(){
		$request = file_get_contents('php://input');
		return json_decode($request,true);
	}



	public function tablas(){
		$data['titulo']="";
		$this->load->view('menu/content',$data);
	}



	public function traeractas(){
		// print($this->acta->getid());
		echo (json_encode($this->acta->getid()));
	}

	public function especies(){
		$r = $this->request();

		echo (json_encode($this->tablaTotales->getFullTable1($r["acta"]),JSON_NUMERIC_CHECK));


	}

	public function getCamps(){
		$r= $this->request();
		echo (json_encode($this->acta->getIdcamp($r["acta"]),JSON_NUMERIC_CHECK));
	}

	public function getTotales(){
		echo (json_encode($this->tablaTotales->getTotal(),JSON_NUMERIC_CHECK));
	}


	//localidades a las que se fue en la campana
	public function getLocalidadesxcamp(){
		// print($this->acta->getid());
		echo (json_encode($this->acta->getLocalidadesxcamp(2)));
	}


	//total de peces por localidad
	public function totalPorLoc(){
		$r = $this->request();
		// echo json_encode($r);
		echo (json_encode($this->acta->totalPorLoc($r["input"]),JSON_NUMERIC_CHECK));
	}

	public function getPorcentajes(){
			$r = $this->request();
			if (isset($r["campania"])){
					$localidades= $this->acta->getIndicesporloc($r["acta"],$r["campania"]);
					$tabla = $this->tablaTotales->getFullTable1($r["acta"],$r["campania"]);
			}else {
				$localidades= $this->acta->getIndicesporloc($r["acta"]);
				$tabla = $this->tablaTotales->getFullTable1($r["acta"]);
			}
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
					if ($k < count($localidades) ){
						$tabla[$key][$this->acta->getInciales($k+1)["iniciales"]]=$v[$this->acta->getInciales($k+1)["iniciales"]] / $loc[$k]["total"];
					}	else{
						$tabla[$key]["total"]=$v["total"] / $loc[$k]["total"];
					}


					// print $v[$this->acta->getInciales($k+1)["iniciales"]];
					// print $loc[$k];
					// $v[$this->acta->getInciales($k+1)] = $tabla[$key][$this->acta->getInciales($k+1)] / $loc[$k];

				}
			}
			echo json_encode($tabla,JSON_NUMERIC_CHECK);

	}


//parametro es la localidad
	public function totalypesoporloc(){
		$r = $this->request();
		// echo json_encode($r);
		echo (json_encode($this->functions->totalypesoporloc($r["loc"],$r["acta"]),JSON_NUMERIC_CHECK));
		// echo (json_encode($this->functions->totalypesoporloc($loc,$acta),JSON_NUMERIC_CHECK));
	}

	public function sumcpueloc()	{
		$r = $this->request();
		echo (json_encode($this->functions->sumcpueloc($r["loc"],$r["acta"]),JSON_NUMERIC_CHECK));
	}


//transformacion de filas por columnas, recibe la loc. y "cpue" o "cpueg"
	public function cuboCpueEspecies()	{
		$r = $this->request();
		echo (json_encode($this->functions->cuboCpueEspecies($r["loc"],$r["opt"]),JSON_NUMERIC_CHECK));
	}

	public function rangocpuelst()	{
		$r = $this->request();
		echo (json_encode($this->functions->rangocpuelst($r["loc"]),JSON_NUMERIC_CHECK));
	}

public function cuentaSexoEsp()	{
	$r = $this->request();
	echo (json_encode($this->functions->cuentaSexoEsp($r["loc"],$r["acta"]),JSON_NUMERIC_CHECK));
}

public function cuentaGonada()	{
	$r = $this->request();
	echo (json_encode($this->functions->cuentaGonada($r["loc"]),JSON_NUMERIC_CHECK));
}

//recibe paarametro de sexo 1=M 2=F
public function cuentaGonadaSexo()	{
	$r = $this->request();
	echo (json_encode($this->functions->cuentaGonadaSexo($r["loc"],$r["sexo"]),JSON_NUMERIC_CHECK));
}

public function cuentaEspGonada()	{
	$r = $this->request();
	echo (json_encode($this->functions->cuentaEspGonada($r["loc"],$r["sexo"]),JSON_NUMERIC_CHECK));
}

public function rgsXCien()	{
	$r = $this->request();
	echo (json_encode($this->functions->rgsXCien($r["loc"]),JSON_NUMERIC_CHECK));
}
public function calcularLargoProm(){
	var_dump($this->functions->calcularLargoProm());
}

public function calcularduracion(){
	var_dump($this->functions->calcularduracion());
}

}
