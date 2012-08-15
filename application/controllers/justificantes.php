<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Justificantes extends CI_Controller {

    public function main() {
        if ($this->session->userdata('active') == FALSE) {
            $this->session->set_userdata('active', get_class($this));
        }
        if ($this->session->userdata('sort') == FALSE || $this->session->userdata('order') == FALSE || $this->session->userdata('active') != get_class($this)) {
            $this->session->set_userdata('active', get_class($this));
            $this->session->set_userdata('sort', 'id');
            $this->session->set_userdata('order', 'des');
        }
        $this->load->model('justificantes_model');
        $this->load->helper('form');
        $this->load->library('pagination');
        //Query
        $offset = $this->uri->segment(3);
        $sort = $this->session->userdata('sort');
        $order = $this->session->userdata('order');
        $limit = PAGINATOR_LIMIT;
        $search = $this->session->userdata('search');
        $query = $this->justificantes_model->getJustificantes($offset, $sort, $order, $limit, $search);
        $this->db->flush_cache();
        //Paginador
        $config['base_url'] = site_url() . '/justificantes/main/' . $sort . '/' . $order . '/';
        $config['total_rows'] = $this->justificantes_model->countJustificantes($search);
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
        $paginator = $this->pagination->create_links();
        //Parse data
        $data = array(
            'query' => $query,
            'paginator' => $paginator
        );
        $data['search'] = $search;
        $data['per_page'] = $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        //Template
        $this->load->library('AucarAssets');
        $assets = new AucarAssets;
        $data['assets'] = $assets->print_assets();
        $this->load->library('AucarMenu');
        $menu = new AucarMenu;
        $data['menu'] = $menu->print_menu();
        $this->load->view('justificantes/home', $data);
    }

    public function order($sort, $order) {
        if (!empty($sort) && !empty($order)) {
            $this->session->set_userdata('sort', $sort);
            $this->session->set_userdata('order', $order);
        }
        redirect('/justificantes/main/');
    }

    public function search() {
        $search = $this->input->post('search');
        if (!empty($search)) {
            $this->session->set_userdata('search', $search);
        }
        redirect('/justificantes/main/');
    }

    public function reset() {
        $this->session->set_userdata('sort', 'id');
        $this->session->set_userdata('order', 'des');
        $this->session->set_userdata('search', '');
        redirect('/justificantes/main/');
    }

    public function edit() {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->library('pagination');
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('justificantes', array('id' => $id));
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
        $this->load->view('justificantes/form', $data);
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
        $this->load->view('justificantes/form', $data);
    }

    public function save() {
        $obj = $this->input->post();

        if (empty($obj['id'])) {
            //$obj['comision'] = $obj['comision'] / 2;
            $this->db->insert('justificantes', $obj);
            redirect('/justificantes/edit/' . $this->db->insert_id());
        } else {
            $id = $obj['id'];
            $this->db->where('id', $obj['id']);
            array_shift($obj);
            $this->db->update('justificantes', $obj);
            redirect('/justificantes/edit/' . $id);
        }
    }

    public function generate($param) {
        $this->load->library('fpdf');
        $mes = $this->input->post('mes');
        $anyo = $this->input->post('anyo');
        $colaboradores_id = $this->input->post('colaboradores_id');
        $query = $this->db->get_where('colaboradores', array('id' => $colaboradores_id));
        $colaborador = $query->row();
        $emisor = array('nombre' => $this->config->item('nombre'), 'direccion' => $this->config->item('direccion'));

        $this->db->select('justificantes.comision as comision,
            justificantes.mes,
            justificantes.anyo,
            polizas.npoliza as numero_poliza,
            clientes.nombre as cliente_nombre,
            clientes.first_apellido as first_apellido,
            clientes.last_apellido as last_apellido,
            colaboradores.nombre as colaborador,
            colaboradores.id as colaboradores_id');
        $this->db->from('colaboradores');
        $this->db->join('polizas', 'polizas.colaboradores_id = colaboradores.id');
        $this->db->join('clientes', 'clientes.id = polizas.clientes_id');
        $this->db->join('justificantes', 'justificantes.polizas_id = polizas.id');
        $this->db->where('anyo', $anyo);
        $this->db->where('mes', $mes);
        $this->db->where('colaboradores_id', $colaboradores_id);

        $query = $this->db->get();
        ob_end_clean();

        $this->fpdf->Open();
        $this->fpdf->SetFont('Helvetica');
        $this->fpdf->AddPage();
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->SetXY(10, 50);
        $this->fpdf->SetFontSize(10);
        // $this->fpdf->SetFont('Arial','B',14);
        $this->fpdf->Image('img/logo/logo.jpg', 10, 10, 50);
        $this->fpdf->SetXY(100, 20);
        $this->fpdf->SetWidths(array(70, 30));
        $this->fpdf->Row(array('Colaborador', 'Fecha'));
        $this->fpdf->SetX(100);
        $this->fpdf->Row(array($colaborador->nombre, $mes . '-' . $anyo));
        $total = 0;
        $this->fpdf->SetY(60);
        $this->fpdf->Cell(140, 6, 'Asegurado', 1, 0, 'C');
        $this->fpdf->Cell(50, 6, html_entity_decode("Comisi&oacute;n", ENT_QUOTES), 1, 1, 'C');
        $this->fpdf->SetWidths(array(140, 50));
        foreach ($query->result() as $row) {
            $total = $total + $row->comision / 2;
            $this->fpdf->Row(array(utf8_decode($row->cliente_nombre . ' ' . $row->first_apellido . ' ' . $row->last_apellido), $row->comision / 2));
        }
        $this->fpdf->setX(90);
        $this->fpdf->Write(5, 'Total:');
        $this->fpdf->setX(150);
        $this->fpdf->Cell(50, 6, $total, 1, 1, 'L');
        $descuento = $total * 25 / 100;
        $neto = $total - $descuento;
        $this->fpdf->setX(90);
        $this->fpdf->Write(5, 'Descuento:');
        $this->fpdf->setX(150);
        $this->fpdf->Cell(50, 6, $descuento, 1, 1, 'L');
        $this->fpdf->setX(90);
        $this->fpdf->Write(5, 'Neto:');
        $this->fpdf->setX(150);
        $this->fpdf->Cell(50, 6, $neto, 1, 1, 'L');


        $this->fpdf->Output($mes . '-' . $anyo . '-' . $colaborador->nombre . '.pdf', 'D');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/justificantes.php */
