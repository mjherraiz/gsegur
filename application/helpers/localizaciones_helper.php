<?php

function getPoblacion($id) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->get_where('poblacion', array('idpoblacion' => $id));
    $obj = $query->row();
    return $obj->poblacion;
}

?>
