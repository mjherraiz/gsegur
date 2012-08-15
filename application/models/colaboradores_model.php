<?php

class Colaboradores_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getColaboradores($offset, $sort, $order, $limit, $search) {
        $this->db->limit($limit, $offset);
        $this->db->order_by($sort, $order);
        if (!empty($search)) {
            $array = array('primer_apellido' => $search, 'segundo_apellido' => $search);
            $this->db->or_like($array);
        }
        return $this->db->get('colaboradores');
    }

    function countColaboradores($search) {
        if (!empty($search)) {
            $array = array('primer_apellido' => $search, 'segundo_apellido' => $search);
            $this->db->or_like($array);
        }
        $this->db->from('colaboradores');
        return $this->db->count_all_results();
    }

}

?>
