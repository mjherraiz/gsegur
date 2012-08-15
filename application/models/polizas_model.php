<?php

class Polizas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPolizas($offset, $sort, $order, $limit, $search) {
        $this->db->limit($limit, $offset);
        $this->db->order_by($sort, $order);
        if (!empty($search)) {
            $array = array('npoliza' => $search);
            $this->db->or_like($array);
        }

        $this->db->select('
          clientes.nombre as nombre,
          clientes.first_apellido as first_apellido,
          clientes.last_apellido as last_apellido,
          clientes.dni as dni,
          polizas.id as id,
          polizas.npoliza as npoliza,
          companyias.nombre as companyia,
          ramos.nombre as ramo,
          polizas.identificador as identificador,
          polizas.descripcion_identificador as descripcion_identificador,
          polizas.riesgo as riesgo,
          polizas.fecha_valido_hasta as fecha_valido_hasta');
        $this->db->from('polizas');
        $this->db->join('clientes', 'polizas.clientes_id = clientes.id');
        $this->db->join('companyias', 'companyias.id = polizas.companyias_id');
        $this->db->join('ramos', 'ramos.id = polizas.ramos_id');
        return $this->db->get();
    }

    function countPolizas($search) {
        if (!empty($search)) {
            $array = array('npoliza' => $search);
            $this->db->or_like($array);
        }
        $this->db->from('polizas');
        return  $this->db->count_all_results();
    }

}

?>
