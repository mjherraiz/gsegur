<?php

class Justificantes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getJustificantes($offset, $sort, $order,$limit, $search) {
        $this->db->limit($limit, $offset);
        $this->db->order_by($sort, $order);
        $this->db->select('
          colaboradores.id as id_colaborador,
          colaboradores.nombre as nombre_colaborador,
          colaboradores.primer_apellido as primer_apellido,
          colaboradores.segundo_apellido as segundo_apellido,
          poblacion.poblacion as poblacion,
          polizas.id as id_poliza,
          polizas.npoliza as npoliza,
          clientes.nombre as clientes_nombre,
          clientes.first_apellido as first_apellido,
          clientes.last_apellido as last_apellido,
          justificantes.id as id,
          justificantes.comision as comision,
          justificantes.mes as mes,
          justificantes.anyo as anyo');
        $this->db->from('justificantes');
        $this->db->join('polizas', 'justificantes.polizas_id = polizas.id');
        $this->db->join('clientes', 'clientes.id = polizas.clientes_id');
        $this->db->join('poblacion', 'clientes.poblacion = poblacion.idpoblacion');
        $this->db->join('colaboradores', 'colaboradores.id = polizas.colaboradores_id');
        $this->db->order_by('mes', 'desc');
        $this->db->order_by('anyo', 'desc');
        if (!empty($search)) {
            $array = array(
                'polizas.npoliza ' => $search,
                'mes' => $search,
                'anyo' => $search,
                'colaboradores.primer_apellido' => $search,
                'clientes.first_apellido' => $search
            );
            $this->db->or_like($array);
        }

        $query = $this->db->get();
        return $query;
    }

    function countJustificantes( $search) {
        $this->db->select('
          colaboradores.id as id_colaborador,
          colaboradores.nombre as nombre_colaborador,
          colaboradores.primer_apellido as primer_apellido,
          colaboradores.segundo_apellido as segundo_apellido,
          poblacion.poblacion as poblacion,
          polizas.id as id_poliza,
          polizas.npoliza as npoliza,
          clientes.nombre as clientes_nombre,
          clientes.first_apellido as first_apellido,
          clientes.last_apellido as last_apellido,
          justificantes.id as id,
          justificantes.comision as comision,
          justificantes.mes as mes,
          justificantes.anyo as anyo');
        $this->db->from('justificantes');
        $this->db->join('polizas', 'justificantes.polizas_id = polizas.id');
        $this->db->join('clientes', 'clientes.id = polizas.clientes_id');
        $this->db->join('poblacion', 'clientes.poblacion = poblacion.idpoblacion');
        $this->db->join('colaboradores', 'colaboradores.id = polizas.colaboradores_id');
        $this->db->order_by('mes', 'desc');
        $this->db->order_by('anyo', 'desc');
        if (!empty($search)) {
            $array = array(
                'polizas.npoliza ' => $search,
                'mes' => $search,
                'anyo' => $search,
                'colaboradores.primer_apellido' => $search,
                'clientes.first_apellido' => $search
            );
            $this->db->or_like($array);
        }
        return $this->db->count_all_results();
    }

}

?>
