<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Colaboradores extends CI_Controller {

    public function main() {
        if ($this->session->userdata('active') == FALSE) {
            $this->session->set_userdata('active', get_class($this));
        }
        if ($this->session->userdata('sort') == FALSE || $this->session->userdata('order') == FALSE || $this->session->userdata('active') != get_class($this)) {
            $this->session->set_userdata('active', get_class($this));
            $this->session->set_userdata('sort', 'id');
            $this->session->set_userdata('order', 'des');
        }
        $this->load->helper('form');
        $this->load->library('pagination');
        $offset = $this->uri->segment(3);
        $sort = $this->session->userdata('sort');
        $order = $this->session->userdata('order');
        $search = $this->session->userdata('search');
        $limit = PAGINATOR_LIMIT;
        $this->load->model('colaboradores_model');
        $query = $this->colaboradores_model->getColaboradores($offset, $sort, $order, $limit, $search);
        $this->db->flush_cache();
        $config['base_url'] = site_url() . '/colaboradores/main/';
        $config['total_rows'] = $this->colaboradores_model->countColaboradores($search);
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
        $paginator = $this->pagination->create_links();
        $data = array(
            'query' => $query,
            'paginator' => $paginator
        );
        $data['search'] = $search;
        $data['per_page'] = $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $this->load->library('AucarAssets');
        $assets = new AucarAssets;
        $data['assets'] = $assets->print_assets();
        $this->load->library('AucarMenu');
        $menu = new AucarMenu;
        $data['menu'] = $menu->print_menu();
        $this->load->view('colaboradores/home', $data);
    }

    public function order($sort, $order) {
        if (!empty($sort) && !empty($order)) {
            $this->session->set_userdata('sort', $sort);
            $this->session->set_userdata('order', $order);
        }
        redirect('/colaboradores/main/');
    }

    public function search() {
        $search = $this->input->post('search');
        if (!empty($search)) {
            $this->session->set_userdata('search', $search);
        }
        redirect('/colaboradores/main/');
    }

    public function reset() {
        $this->session->set_userdata('sort', 'id');
        $this->session->set_userdata('order', 'des');
        $this->session->set_userdata('search', '');

        redirect('/colaboradores/main/');
    }

    public function edit() {
        $this->load->helper('form');
        $this->load->library('pagination');
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('colaboradores', array('id' => $id));
        $obj = $query->row();
        $data = array(
            'obj' => $obj
        );
        $this->load->library('AucarAssets');
        $assets = new AucarAssets;
        $data['assets'] = $assets->print_assets();
        $this->load->library('AucarMenu');
        $menu = new AucarMenu;
        $data['menu'] = $menu->print_menu();
        $this->load->view('colaboradores/form', $data);
    }

    public function add() {
        $this->load->helper('form');
        $this->load->library('pagination');
        $id = $this->uri->segment(3);

        $data = array(
            'obj' => null
        );
        $this->load->library('AucarAssets');
        $assets = new AucarAssets;
        $data['assets'] = $assets->print_assets();
        $this->load->library('AucarMenu');
        $menu = new AucarMenu;
        $data['menu'] = $menu->print_menu();
        $this->load->view('colaboradores/form', $data);
    }

    public function save() {
        $obj = $this->input->post();
        if (empty($obj['id'])) {
            $this->db->insert('colaboradores', $obj);
            redirect('/colaboradores/edit/' . $this->db->insert_id());
        } else {
            $id = $obj['id'];
            $this->db->where('id', $obj['id']);
            array_shift($obj);
            $this->db->update('colaboradores', $obj);
            redirect('/colaboradores/edit/' . $id);
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/colaboradores.php */