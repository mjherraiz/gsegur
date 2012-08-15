<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AucarMenu {

    public function print_menu() {
        $obj = & get_instance();
        $obj->load->helper('url');
        $menu = '<ul id="navigation">';
        $menu .= "<li>";
        $menu .= anchor("", "Inicio");
        $menu .= "</li>";
        $menu .= "<li>";
        $menu .= anchor("clientes/main", "Clientes");
        $menu .= "</li>";
        $menu .= "<li>";
        $menu .= anchor("colaboradores/main", "Colaboradores");
        $menu .= "</li>";
        $menu .= "<li>";
        $menu .= anchor("polizas/main", "Polizas");
        $menu .= "</li>";
        $menu .= "<li>";
        $menu .= anchor("justificantes/main", "Comisiones");
        $menu .= "</li>";
        //$menu .= "<li>";
        //$menu .= anchor("informes/main", "Informes");
        //$menu .= "</li>";
        //$menu .= "<li>";
        //$menu .= anchor("facturas/main", "Facturas");
        //$menu .= "</li>";
        //$menu .= "<li>";
        //$menu .= '<a href="http://localhost/phpmyadmin/">phpMyAdmin</a>';
        //$menu .= "</li>";
        $menu .= "</ul>";


        return $menu;
    }

}

/* End of file Aucarmenu.php */