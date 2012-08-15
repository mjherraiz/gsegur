<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        //$this->load->model('Justificantes_model');
        // $data['query'] = $this->Justificantes_model->get_last_ten_justificante();
        $this->load->library('AucarAssets');
        $assets = new AucarAssets;
        $data['assets'] = $assets->print_assets();
        $this->load->library('AucarMenu');
        $menu = new AucarMenu;
        $data['menu'] = $menu->print_menu();

        $this->db->select('*,polizas.id as id_poliza');
        $this->db->from('polizas');
        $this->db->join('clientes', 'clientes.id = polizas.clientes_id');
        $this->db->where('fecha_valido_hasta >', date('Y-m-d', strtotime('now')));
        $this->db->where('fecha_valido_hasta <', date('Y-m-d', strtotime('+60 days')));
        $this->db->order_by('fecha_valido_hasta', 'ASC');
        $query = $this->db->get();

        $data['polizas'] = $query->result();

        $this->load->view('home', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */