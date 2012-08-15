<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AucarAssets {

    public function print_assets() {
        $obj = & get_instance();
        $obj->load->helper('html');
        $assets = '<script type="text/javascript" src="' . base_url() . 'js/jquery-1.7.1.js"></script>';
        $assets .='<script type="text/javascript" src="' . base_url() . 'js/jquery-ui-1.8.17.custom.js"></script>';
        $assets .='<script type="text/javascript" src="' . base_url() . 'js/combobox.js"></script>';
        $assets .='<script type="text/javascript" src="' . base_url() . 'js/doc-ready.js"></script>';
        $assets .='<script type="text/javascript" src="' . base_url() . 'js/elfinder.min.js"></script>';
        $assets .= link_tag('css/grid/reset.css');
        $assets .= link_tag('css/grid/text.css');
        $assets .= link_tag('css/grid/fluid_grid.css');
        $assets .= link_tag('css/theme.css');
                $assets .= link_tag('css/themeelfinder.css');
        $assets .= link_tag('css/custom-theme/jquery-ui-1.8.17.custom.css');
        return $assets;
    }

}

/* End of file Aucarmenu.php */