<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Polizas extends CI_Controller {

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
        $config['uri_segment'] = 5;
        $offset = $this->uri->segment(5);
        $sort = $this->session->userdata('sort');
        $order = $this->session->userdata('order');
        $search = $this->session->userdata('search');
        $limit = PAGINATOR_LIMIT;
        $this->load->model('polizas_model');
        $query = $this->polizas_model->getPolizas($offset, $sort, $order, $limit, $search);
        $this->db->flush_cache();
        $config['base_url'] = site_url() . '/polizas/main/' . $sort . '/' . $order . '/';
        $config['total_rows'] = $this->polizas_model->countPolizas($search);
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
        $this->load->view('polizas/home', $data);
    }

    public function order($sort, $order) {
        if (!empty($sort) && !empty($order)) {
            $this->session->set_userdata('sort', $sort);
            $this->session->set_userdata('order', $order);
        }
        redirect('/polizas/main/');
    }

    public function search() {
        $search = $this->input->post('search');
        if (!empty($search)) {
            $this->session->set_userdata('search', $search);
        }
        redirect('/polizas/main/');
    }

    public function reset() {
        $this->session->set_userdata('sort', 'id');
        $this->session->set_userdata('order', 'des');
        $this->session->set_userdata('search', '');

        redirect('/polizas/main/');
    }

    public function edit() {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->library('pagination');
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('polizas', array('id' => $id));
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
        $data['error'] = '';
        $this->load->view('polizas/form', $data);
    }

    public function add() {
        $this->load->helper('form');
        $this->load->helper('html');
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
        $this->load->view('polizas/form', $data);
    }

    public function save() {
        $obj = $this->input->post();
        $vitalicio = $this->input->post('vitalicio');
        $obj['vitalicio'] = $vitalicio[0];
        $obj['fecha_valido_hasta'] = date('Y-m-d', strtotime($obj['fecha_valido_hasta']));
        $obj['fecha_efecto'] = date('Y-m-d', strtotime($obj['fecha_efecto']));

        if (empty($obj['id'])) {
            $this->db->insert('polizas', $obj);
            $this->db->insert_id();
            redirect('/polizas/edit/' . $this->db->insert_id());
        } else {
            $id = $obj['id'];
            $this->db->where('id', $obj['id']);
            array_shift($obj);
            $this->db->update('polizas', $obj);
            redirect('/polizas/edit/' . $id);
        }
    }

    function upload_file() {

        $polizas_id = $this->input->post('polizas_id');
        if (!is_dir('./' . DATAFOLDER . '/polizas/' . $polizas_id)) {
            mkdir('./' . DATAFOLDER . '/polizas/' . $polizas_id, 0777);
        }
        $config['upload_path'] = './' . DATAFOLDER . '/polizas/' . $polizas_id . '/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            die(var_dump($error));
        } else {

            redirect('/polizas/edit/' . $polizas_id);
        }
    }

    public function delete() {
        $file = base64_decode(str_pad(strtr($this->uri->segment(5), '-_', '+/'), strlen($this->uri->segment(3)) % 4, '=', STR_PAD_RIGHT));
        @unlink($file);
        redirect('/' . $this->uri->segment(3) . '/edit/' . $this->uri->segment(4));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/polizas.php */