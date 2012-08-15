<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Informes extends CI_Controller {

    public function main() {
        $this->load->library('pagination');
        $offset = $this->uri->segment(3);
        $limit = PAGINATOR_LIMIT;
        $this->db->limit($limit, $offset);
            $this->db->order_by("anyo", "desc");
        $this->db->order_by("mes", "desc");
    

        $this->db->select('SUM(justificantes.comision)as comision,justificantes.mes,justificantes.anyo,polizas.npoliza as numero_poliza,clientes.nombre as cliente_nombre,colaboradores.nombre as colaborador');
        $this->db->from('colaboradores');
        $this->db->join('polizas', 'polizas.colaboradores_id = colaboradores.id');
        $this->db->join('clientes', 'clientes.id = polizas.clientes_id');
        $this->db->join('justificantes', 'justificantes.polizas_id = polizas.id');
        $this->db->group_by(array("colaborador", "anyo","mes")); 
        $query = $this->db->get();
        $config['base_url'] = site_url() . '/informes/main/';
        //$config['total_rows'] = $this->db->count_all($query);
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
        $paginator = $this->pagination->create_links();
        $data = array(
            'query' => $query,
            'paginator' => $paginator
        );
        $this->load->library('AucarAssets');
        $assets = new AucarAssets;
        $data['assets'] = $assets->print_assets();
        $this->load->library('AucarMenu');
        $menu = new AucarMenu;
        $data['menu'] = $menu->print_menu();



        $this->load->view('informes/home', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/clientes.php */