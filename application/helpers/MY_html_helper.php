<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function comboClientes($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->query("SELECT id, nombre, first_apellido, last_apellido,dni FROM clientes");
    $combo = '<select id="clientes_id"  name="clientes_id">';
    foreach ($query->result() as $row) {
        $combo.='<option value="' . $row->id . '"';
        if ($row->id == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $row->nombre . ' ' . $row->first_apellido . ' ' . $row->last_apellido . ' ' . $row->dni . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function combosegundo_titular($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->query("SELECT id, nombre, first_apellido, last_apellido,dni FROM clientes");
    $combo = '<select id="segundo_titular"  name="segundo_titular">';
    foreach ($query->result() as $row) {
        $combo.='<option value="' . $row->id . '"';
        if ($row->id == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $row->nombre . ' ' . $row->first_apellido . ' ' . $row->last_apellido . ' ' . $row->dni . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function comboModalidades($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->query("SELECT id, nombre FROM modalidades");
    $combo = '<select id="modalidades_id"  name="modalidades_id">';
    foreach ($query->result() as $row) {
        $combo.='<option value="' . $row->id . '"';
        if ($row->id == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $row->nombre . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function comboRamos($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->query("SELECT id, nombre FROM ramos");
    $combo = '<select id="ramos_id"  name="ramos_id">';
    foreach ($query->result() as $row) {
        $combo.='<option value="' . $row->id . '"';
        if ($row->id == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $row->nombre . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function comboColaboradores($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->query("SELECT id, nombre FROM colaboradores");
    $combo = '<select id="colaboradores_id"  name="colaboradores_id">';
    foreach ($query->result() as $row) {
        $combo.='<option value="' . $row->id . '"';
        if ($row->id == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $row->nombre . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function comboPolizas($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->query("SELECT id, npoliza FROM polizas");
    $combo = '<select id="polizas_id"  name="polizas_id">';
    foreach ($query->result() as $row) {
        $combo.='<option value="' . $row->id . '"';
        if ($row->id == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $row->npoliza . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function comboAnyo($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->helper('date');
    $combo = '<select id="anyo"  name="anyo">';
    for ($i = mdate('%Y', time()); $i >= 1900; $i--) {
        $combo.='<option value="' . $i . '"';
        if ($i == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $i . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function comboMes($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->helper('date');
    $combo = '<select id="mes"  name="mes">';
    for ($i = 1; $i <= 12; $i++) {
        $combo.='<option value="' . $i . '"';
        if ($i == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $i . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function fileList($type = 'ul', $list, $attributes = '', $depth = 0, $directory,$table,$owner) {
    // If an array wasn't submitted there's nothing to do...
    if (!is_array($list)) {
        return $list;
    }

    // Set the indentation based on the depth
    $out = str_repeat(" ", $depth);

    // Were any attributes submitted?  If so generate a string
    if (is_array($attributes)) {
        $atts = '';
        foreach ($attributes as $key => $val) {
            $atts .= ' ' . $key . '="' . $val . '"';
        }
        $attributes = $atts;
    } elseif (is_string($attributes) AND strlen($attributes) > 0) {
        $attributes = ' ' . $attributes;
    }

    // Write the opening list tag
    $out .= "<" . $type . $attributes . ">\n";

    // Cycle through the list elements.  If an array is
    // encountered we will recursively call _list()

    static $_last_list_item = '';
    foreach ($list as $key => $val) {
        $_last_list_item = $key;

        $out .= str_repeat(" ", $depth + 2);
        $out .= "<li>";

        if (!is_array($val)) {
            $out .= anchor(base_url($directory . $val), $val);
        } else {
            $out .= $_last_list_item . "\n";
            $out .= _list($type, $val, '', $depth + 4);
            $out .= str_repeat(" ", $depth + 2);
        }
        $url =rtrim(strtr(base64_encode($directory . $val), '+/', '-_'), '=');
        $out .= anchor(site_url($table.'/delete/'.$table.'/'.$owner.'/'.$url), '<span class="ui-icon ui-icon-circle-close"></span>');
        $out .= "</li>\n";
    }

    // Set the indentation for the closing tag
    $out .= str_repeat(" ", $depth);

    // Write the closing list tag
    $out .= "</" . $type . ">\n";

    return $out;
}

function comboProvincias($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->query("SELECT idprovincia, provincia FROM provincia ORDER BY provincia");
    $combo = '<select id="provincia"  name="provincia">';
    foreach ($query->result() as $row) {
        $combo.='<option value="' . $row->idprovincia . '"';
        if ($row->idprovincia == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $row->provincia . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function comboLocalizaciones($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    if (!is_null($selected)) {
        $query = $CI->db->query("SELECT idprovincia FROM poblacion WHERE idpoblacion='$selected'");
        $idprovincia = $query->row()->idprovincia;
        $query = $CI->db->query("SELECT idpoblacion, poblacion FROM poblacion WHERE idprovincia='$idprovincia'  ORDER BY poblacion");
        $combo = '<select id="poblacion"  name="poblacion">';
        foreach ($query->result() as $row) {
            $combo.='<option value="' . $row->idpoblacion . '"';
            if ($row->idpoblacion == $selected) {
                $combo.=' selected="selected" ';
            }
            $combo.='">' . $row->poblacion . '</option>';
        }
        $combo .= '</select>';
    } else {
        $idprovincia = 22;
        $query = $CI->db->query("SELECT idpoblacion, poblacion FROM poblacion WHERE idprovincia='$idprovincia'  ORDER BY poblacion");
        $combo = '<select id="poblacion"  name="poblacion">';
        foreach ($query->result() as $row) {
            $combo.='<option value="' . $row->idpoblacion . '"';
            if ($row->idpoblacion == $selected) {
                $combo.=' selected="selected" ';
            }
            $combo.='">' . $row->poblacion . '</option>';
        }
        $combo .= '</select>';
    }
    return '<label for="poblacion">Población</label><div class="clear"></div>' . $combo . '<div class="clear"></div><label for="provincia">Provincia</label><div class="clear"></div>' . comboProvincias($idprovincia) . '<div class="clear"></div>';
}

function comboTipo($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->query("SELECT id, nombre FROM tipo ");
    $combo = '<select id="tipo"  name="tipo">';
    foreach ($query->result() as $row) {
        $combo.='<option value="' . $row->id . '"';
        if ($row->id == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $row->nombre . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

function comboCompanyia($selected = null) {
    $CI = & get_instance();
    $CI->load->helper('url');
    $CI->load->database();
    $query = $CI->db->query("SELECT id, nombre FROM companyias ");
    $combo = '<select id="companyias_id"  name="companyias_id">';
    foreach ($query->result() as $row) {
        $combo.='<option value="' . $row->id . '"';
        if ($row->id == $selected) {
            $combo.=' selected="selected" ';
        }
        $combo.='">' . $row->nombre . '</option>';
    }
    $combo .= '</select>';
    return $combo;
}

?>
