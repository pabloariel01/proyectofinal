<?php
class Modelo_acta extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }
   public function guardar($descripcion, $id=null){
      $data = array(
         'descripcion' => $descripcion,
      );
      if($id){
         $this->db->where('id', $id);
         $this->db->update('acta', $data);
      }else{
         $this->db->insert('acta', $data);
      } 
   }
   public function eliminar($id){
      $this->db->where('id', $id);
      $this->db->delete('acta');
   }
   public function obtener_por_id($id){
      $this->db->select('id, descripcion');
      $this->db->from('acta');
      $this->db->where('id', $id);
      $consulta = $this->db->get();
      $resultado = $consulta->row();
      return $resultado;
   }
   public function obtener_todos(){
      $this->db->select('id, descripcion');
      $this->db->from('acta');
      $this->db->order_by('descipcion', 'desc');
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
   }
}