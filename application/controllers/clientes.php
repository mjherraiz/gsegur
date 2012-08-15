<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clientes extends CI_Controller {

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
        $this->load->model('clientes_model');
        $query = $this->clientes_model->getClientes($offset, $sort, $order, $limit, $search);
        $this->db->flush_cache();
        $config['base_url'] = site_url() . '/clientes/main/';
        $config['total_rows'] = $this->clientes_model->countClientes($search);
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
        $this->load->view('clientes/home', $data);
    }

    public function order($sort, $order) {
        if (!empty($sort) && !empty($order)) {
            $this->session->set_userdata('sort', $sort);
            $this->session->set_userdata('order', $order);
        }
        redirect('/clientes/main/');
    }

    public function search() {
        $search = $this->input->post('search');
        if (!empty($search)) {
            $this->session->set_userdata('search', $search);
        }
        redirect('/clientes/main/');
    }

    public function reset() {
        $this->session->set_userdata('sort', 'id');
        $this->session->set_userdata('order', 'des');
        $this->session->set_userdata('search', '');

        redirect('/clientes/main/');
    }

    public function edit() {
        $this->load->helper('path');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->library('pagination');
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('clientes', array('id' => $id));
        $obj = $query->row();
        $query = $this->db->get_where('polizas', array('clientes_id' => $id));
        $polizas = array();
        $i = 0;
        /* TODO esto es un churro */
        foreach ($query->result() as $poliza) {
            $polizas[$i]['id'] = $poliza->id;
            $polizas[$i]['npoliza'] = $poliza->npoliza;
            $polizas[$i]['fecha_valido_hasta'] = $poliza->fecha_valido_hasta;
            $ramo = $this->db->get_where('ramos', array('id' => $poliza->ramos_id));
            $polizas[$i]['ramo'] = $ramo->row();
            $modalidad = $this->db->get_where('modalidades', array('id' => $poliza->modalidades_id));
            $polizas[$i]['modalidad'] = $modalidad->row();
            $i++;
        }
        $data = array(
            'obj' => $obj,
            'polizas' => $polizas
        );
        $this->load->library('AucarAssets');
        $assets = new AucarAssets;
        $data['assets'] = $assets->print_assets();
        $this->load->library('AucarMenu');
        $menu = new AucarMenu;
        $data['menu'] = $menu->print_menu();
        $this->load->view('clientes/form', $data);
    }

    public function add() {
        $this->load->helper('form');
        $this->load->helper('date');
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
        $this->load->view('clientes/form', $data);
    }

    public function save() {
        $obj = $this->input->post();
        $obj['fecha_nacimiento'] = date('Y-m-d', strtotime($obj['fecha_nacimiento']));
        /* Bug */
        $obj['fecha_carnet'] = date('Y-m-d', strtotime($obj['fecha_carnet']));
        if (empty($obj['id'])) {
            $this->db->insert('clientes', $obj);
            redirect('/clientes/edit/' . $this->db->insert_id());
        } else {
            $id = $obj['id'];
            $this->db->where('id', $obj['id']);
            array_shift($obj);
            $this->db->update('clientes', $obj);
            redirect('/clientes/edit/' . $id);
        }
    }

    function erase() {
        $id = $this->uri->segment(3);
        if (is_dir('./' . DATAFOLDER . '/clientes/' . $id)) {
            $mydir = './' . DATAFOLDER . '/clientes/' . $id;
            $d = dir($mydir);
            while ($entry = $d->read()) {
                if ($entry != "." && $entry != "..") {
                    unlink($mydir . '/' . $entry);
                }
            }
            $d->close();
            rmdir($mydir);
        }
        $query = $this->db->get_where('polizas', array('clientes_id' => $id));
        foreach ($query->result() as $poliza) {
            $this->db->where('id', $poliza->id);
            $this->db->delete('polizas');
        }
        $this->db->where('id', $id);
        $this->db->delete('clientes');
        redirect('/clientes/main/');
    }

    public function getlocalidades() {
        $provincia = $this->uri->segment(3);
        $this->db->select('idpoblacion, poblacion');
        $this->db->where('idprovincia', $provincia);
        $query = $this->db->get('poblacion');
        echo json_encode($query->result_array());
    }

    function upload_file() {
        $polizas_id = $this->input->post('clientes_id');
        if (!is_dir('./' . DATAFOLDER . '/clientes/' . $polizas_id)) {
            mkdir('./' . DATAFOLDER . '/clientes/' . $polizas_id, 0777);
        }
        $config['upload_path'] = './' . DATAFOLDER . '/clientes/' . $polizas_id . '/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            die(var_dump($error));
        } else {
            redirect('/clientes/edit/' . $polizas_id);
        }
    }

    public function delete() {
        $file = base64_decode(str_pad(strtr($this->uri->segment(5), '-_', '+/'), strlen($this->uri->segment(3)) % 4, '=', STR_PAD_RIGHT));
        @unlink($file);
        redirect('/' . $this->uri->segment(3) . '/edit/' . $this->uri->segment(4));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/clientes.php */