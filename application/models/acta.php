<?php
class Acta extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
        //trae todas las actas
        public function getid()
        {
        	$query = $this->db->get('acta');
        	// $query= $this->db->query('select * from acta');

            // print(json_encode($query->result()));
            return $query->result();
        }


        //localidades en donde se pesco en la campana
        //agregar parametro de entrada
        public function getLocalidadesxcamp($value=FALSE)
        {
        	$this->db->from('acta');
            $this->db->join('campaña','acta.id=campaña.acta_id');
            $this->db->join('`campaña-localidad`','campaña.`idcampaña` = `campaña-localidad`.`idcampaña` AND `campaña`.`acta_id` = `campaña-localidad`.`id_acta`');
            $this->db->join('localidad','`campaña-localidad`.`localidad_id` = `localidad`.`idlocalidad`');
            $this->db->select('localidad.iniciales, localidad.idlocalidad');
            $where = "campaña.idcampaña=".$value;
            $this->db->where($where);
            
            
            $query = $this->db->get_where();


            return $query->result_array();
        }

        public function getIndicesloc($value)
        {
            $this->db->from('acta');
            $this->db->distinct();
            $this->db->join('campaña','acta.id=campaña.acta_id');
            $this->db->join('`campaña-localidad`','campaña.`idcampaña` = `campaña-localidad`.`idcampaña` AND `campaña`.`acta_id` = `campaña-localidad`.`id_acta`');
            $this->db->join('localidad','`campaña-localidad`.`localidad_id` = `localidad`.`idlocalidad`');
            $this->db->select('localidad.idlocalidad');
            //agregar un where para id de acta
            $where="acta.id = ".$value;
            $this->db->where($where);
            $query=$this->db->get_where();

            return $query->result_array();
        }

        public function getInciales($value='')
        {
            $this->db->from('localidad')
                    ->select('iniciales')
                    
                    ->where('idlocalidad=', $value);
                    $query=$this->db->get_where();
                    return ($query->row_array());
        }




        public function totalPorLoc($value=FALSE)
        {

            $this->db->from("pescado")
                        ->select("count(*) as total")
                        ->join("pesca","pescado.pesca_id=pesca.id")
                        ->join("`campaña-localidad`","pesca.`campaña-localidad_id` = `campaña-localidad`.id")
                        ->join("localidad","`campaña-localidad`.`localidad_id` = `localidad`.`idlocalidad`");
                    if ($value!=FALSE)
                    {
                    $this->db->where('localidad.idlocalidad=', $value);
                    }
                    $query=$this->db->get_where();
                    return ($query->row_array());            
        }

        


}

