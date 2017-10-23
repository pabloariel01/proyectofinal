<?php
class Functions extends CI_Model {

        public function __construct() {
                // Call the CI_Model constructor
                parent::__construct();
        }

        function totalypesoporloc($loc,$acta){
        try {
            // $this->db->reconnect();
            $sql = "CALL totalypesoporloc(?,?)";
            $result = $this->db->query($sql,array($loc,$acta)); // $data included 3 param and binding & query to db
            // $this->db->close();


        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result->result_array();
        // return $query->result_array();
    }

    function sumcpueloc($data,$acta){
        try {
            // $this->db->reconnect();
            $sql = "CALL `sumcpueloc`(?,?)";
            $result = $this->db->query($sql,array($data,$acta)); // $data included 3 param and binding & query to db
            // $this->db->close();


        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result->result_array();
    }


    function rgsXCien($loc){
        try {
            // $this->db->reconnect();
            $sql = "CALL `rgsXCien`(?)";
            $result = $this->db->query($sql,$loc); // $data included 3 param and binding & query to db
            // $this->db->close();


        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result->result_array();
    }

    function rangocpuelst($data){
        try {
            // $this->db->reconnect();
            $sql = "CALL `rangocpuelst`(?)";
            $result = $this->db->query($sql,$data); // $data included 3 param and binding & query to db
            // $this->db->close();


        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result->result_array();
    }

    function cuentaSexoEsp($loc,$acta){
        try {
            // $this->db->reconnect();
            $sql = "CALL `cuentaSexoEsp`(?,?)";
            $result = $this->db->query($sql,array($loc,$acta)); // $data included 3 param and binding & query to db
            // $this->db->close();


        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result->result_array();
    }




    function cuentaGonada($data){
        try {
            // $this->db->reconnect();
            $sql = "CALL `cuentaGonada`(?)";
            $result = $this->db->query($sql,$data); // $data included 3 param and binding & query to db
            // $this->db->close();


        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result->result_array();
    }


    function cuentaGonadaSexo($data,$sexo){
        try {
            // $this->db->reconnect();
            $sql = "CALL `cuentaGonadaSexo`(?,?)";
            $result = $this->db->query($sql,array($data,$sexo)); // $data tiene que llevar loc/sexo
            // $this->db->close();


        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result->result_array();
    }


        function cuentaEspGonada($loc,$sexo){
            try {
                // $this->db->reconnect();
                $sql = "CALL `cuentaEspGonada`(?,?)";
                $result = $this->db->query($sql,array($loc,$sexo)); // $data tiene que llevar loc/sexo
                // $this->db->close();


            } catch (Exception $e) {
                echo $e->getMessage();
            }
            return $result->result_array();
        }



            function cuboCpueEspecies($loc,$opt){
                try {
                    // $this->db->reconnect();
                    $sql = "CALL `cuboCpueEspecies`(?,?)";
                    $result = $this->db->query($sql,array($loc,$opt)); // $data segundo argumento cpue o cpueg
                    // $this->db->close();


                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                return $result->result_array();
            }

            function calcularLargoProm(){
                try {
                    // $this->db->reconnect();
                    $sql = "CALL `calcularLargoProm`()";
                    $result = $this->db->query($sql); // $data segundo argumento cpue o cpueg
                    // $this->db->close();


                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                return $result->result_array();
            }

}
