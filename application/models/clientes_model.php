<?php

class Clientes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getClientes($offset, $sort, $order, $limit, $search) {
        $this->db->limit($limit, $offset);
        $this->db->order_by($sort, $order);
        if (!empty($search)) {
            $array = array('dni' => $search, 'last_apellido' => $search, 'first_apellido' => $search);
            $this->db->or_like($array);
        }
        return $this->db->get('clientes');
    }

    function countClientes($search) {
        if (!empty($search)) {
            $array = array('dni' => $search, 'last_apellido' => $search, 'first_apellido' => $search);
            $this->db->or_like($array);
        }
        $this->db->from('clientes');
        return $this->db->count_all_results();
    }

}

?>
