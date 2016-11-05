<?php
class TablaTotales extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        //totales por especie en itu/ita
        public function gettable()
        {
            $this->db->from('pescado');
            $this->db->join('especie', 'pescado.especie_id = especie.id');
            $this->db->join('pesca','pescado.pesca_id=pesca.id');
            $this->db->join('`campaña-localidad`','pesca.`campaña-localidad_id`=`campaña-localidad`.id');
            $this->db->join('localidad','`campaña-localidad`.`localidad_id` = `localidad`.`idlocalidad`');
            $this->db->select('especie.descripcion , count(especie.descripcion) as total');
            
            $where = "localidad.iniciales='ITU' OR localidad.iniciales='ITA'";
            $this->db->where($where);
            
            $this->db->group_by("especie.descripcion");


            $query = $this->db->get_where();


            return $query->result_array();
        }
        // total de peces
        public function getTotal()
        {
            $this->db->from('pescado');
            $this->db->join('especie', 'pescado.especie_id = especie.id');
            $this->db->join('pesca','pescado.pesca_id=pesca.id');
            $this->db->join('`campaña-localidad`','pesca.`campaña-localidad_id`=`campaña-localidad`.id');
            $this->db->join('localidad','`campaña-localidad`.`localidad_id` = `localidad`.`idlocalidad`');
            $this->db->select('count(especie.descripcion) as total');
            
            // $where = "localidad.iniciales='ITU' OR localidad.iniciales='ITA'";
            // $this->db->where($where);
            
            // $this->db->group_by("especie.descripcion");


            $query = $this->db->get_where();


            return $query->result_array();	
        }

        public function getFullTable($cons=FALSE)
        {
            $this->db->from('pescado');
            $this->db->join('especie', 'pescado.especie_id = especie.id');
            $this->db->join('pesca','pescado.pesca_id=pesca.id');
            $this->db->join('`campaña-localidad`','pesca.`campaña-localidad_id`=`campaña-localidad`.id');
            $this->db->join('localidad','`campaña-localidad`.`localidad_id` = `localidad`.`idlocalidad`');
            $this->db->select('especie.descripcion as id, count(especie.descripcion) as total');
            
            // $where = "localidad.idlocalidad=1";
            if ($cons === FALSE)
                {
                    $this->db->group_by("especie.descripcion");
                    $this->db->order_by('total', 'DESC');
                    $query = $this->db->get_where();
                    return $query->result_array();
                }


            $where = $cons;
            $this->db->where($where);
            
            $this->db->group_by("especie.descripcion");
            $this->db->order_by('total', 'DESC');
            
            
            $query = $this->db->get_where();


            return $query->result_array();
        }

        // tabla de totales de totales
         public function getFullTable1($value=FALSE)
        {
            $this->load->model('acta');
            $localidades= $this->acta->getIndicesloc($value);
            $subquery=[];
            $subquery1=[];
            $subqueryin=[];
            $subquerynotin=[];
            $subqueryfinal=[];
             // foreach de totales por locs
            for ($k=0; $k < (count($localidades)+1); $k++) { 
                
                // subconsulta de las especies que salieron en la localidad
                $this->db->from('pescado')
                            ->select('especie_id');
                $this->db->join('especie', 'pescado.especie_id = especie.id');
                $this->db->join('pesca','pescado.pesca_id=pesca.id');
                $this->db->join('`campaña-localidad`','pesca.`campaña-localidad_id`=`campaña-localidad`.id');
                $this->db->join('localidad','`campaña-localidad`.`localidad_id` = `localidad`.`idlocalidad`');
                if ($k < count($localidades) ) 
                {
                        $where = "localidad.idlocalidad=" . ($k+1);
                        $this->db->where($where);
                } 
                $where="`campaña-localidad`.id_acta=" . $value;
                $this->db->where($where);
                $this->db->group_by("especie.descripcion");   
                $subqueryin[$k] = $this->db->get_compiled_select();
                $this->db->reset_query();


                //consulta para el not in
                $this->db->from('pescado')
                            ->select('especie_id ,0 as total');
                $this->db->distinct();
                $this->db->join('especie', 'pescado.especie_id = especie.id');
                $this->db->join('pesca','pescado.pesca_id=pesca.id');
                $this->db->join('`campaña-localidad`','pesca.`campaña-localidad_id`=`campaña-localidad`.id');
                $this->db->join('localidad','`campaña-localidad`.`localidad_id` = `localidad`.`idlocalidad`');
                
                // $this->db->group_by("especie.descripcion");   
                
                
                $subquerynotin[$k] = $this->db->get_compiled_select();
                $this->db->reset_query();

                // $this->db->query( $subquery1[$k] .' UNION '. $subqueryfinal[$k]);

                   // print $subqueryin[$k];  

                $this->db->query($subquerynotin[$k] .' where especie.id not in('. $subqueryin[$k] .')');

                // $this->db->or_where_not_in($subquerynotin[$k], $subqueryin[$k]);
                // print $subquerynotin[$k] .' where especie.id not in('. $subqueryin[$k] .')';
                $subqueryfinal[$k]=$subquerynotin[$k] .' where especie.id not in('. $subqueryin[$k] .')';
                // $subqueryfinal[$k] = $this->db->get_compiled_select();
                $this->db->reset_query();

                //subquery
                $this->db->from('pescado');
                $this->db->join('especie', 'pescado.especie_id = especie.id');
                $this->db->join('pesca','pescado.pesca_id=pesca.id');
                $this->db->join('`campaña-localidad`','pesca.`campaña-localidad_id`=`campaña-localidad`.id');
                $this->db->join('localidad','`campaña-localidad`.`localidad_id` = `localidad`.`idlocalidad`');
                $this->db->select('especie.id, count(especie.descripcion) as total');
                
                if ($k < count($localidades) ) 
                    {
                        $where = "localidad.idlocalidad=" . ($k+1);
                        $this->db->where($where);
                       
                        
                    } 
                 $where="`campaña-localidad`.id_acta=" . $value;
                 $this->db->where($where);
                 $this->db->group_by("especie.descripcion");
                 
                
                
                 $subquery1[$k] = $this->db->get_compiled_select();
                 $this->db->reset_query();



                 
            //aca hace la union del final con la subquery
            // print ($subquery1[$k] .' UNION '. $subqueryfinal[$k]);
                 // print $subqueryfinal[$k];
            $this->db->query( $subquery1[$k] .' UNION '. $subqueryfinal[$k]); 

            $subquery[$k]= $subquery1[$k] .' UNION '. $subqueryfinal[$k];
            // $subquery[$k] = $this->db->get_compiled_select();
            }
            



             //main
            $locs=[];
            for ($k=0; $k < (count($localidades)+1); $k++) {
                $locs[$k]=$this->acta->getInciales($k+1)["iniciales"];
            }
            $this->db->reset_query();

            $this->db->from('especie');

            $consulta='especie.descripcion';
            for ($k=0; $k < (count($localidades)+1); $k++) {

                $tabla="tabla".($k+1);
                $this->db->join( '(' . $subquery[$k] . ') as '.$tabla ,'`especie`.`id` = `'.$tabla.'`.`id` ');

                // join( '(' . $subquery[4] . ') as tabla5' ,'especie.id = tabla5.id ');
                if ($k < count($localidades) ) 
                    {
                    $consulta=$consulta.',(select ifnull('.$tabla.'.total,0)) as '. $locs[$k];
                    } 
                    else{
                        $consulta=$consulta.',(select ifnull('.$tabla.'.total,0)) as total';
                        }

            
            }

            $this->db->order_by('total', 'DESC');
            $this->db->select($consulta);
            // $this->db->select('especie.descripcion,(select ifnull(tabla1.total,0)) as a,(select ifnull(tabla2.total,0)) as b,(select ifnull(tabla3.total,0)) as c,(select ifnull(tabla4.total,0)) as d,(select ifnull(tabla5.total,0)) as total');
            
            $query = $this->db->get_where();

                    // return $this->db->get_compiled_select();
            return $query->result_array();
        }


        public function getAcumuladaLoc()
        {
           
        }



}
