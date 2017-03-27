<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES ., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Jan 10, 2011 6:04:30 PM
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!nv_function_exists('nv_block_rada')) {
    /**
     * nv_block_config_rada()
     * 
     * @param mixed $module
     * @param mixed $data_block
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_rada($module, $data_block, $lang_block)
    {
        $html = '';
        $html .= '<tr>';
        $html .= '<td>' . $lang_block['partner'] . '</td>';
        $html .= '<td><input type="text" class="form-control" name="config_partner" value="' . $data_block['partner'] . '" style="width:250px"/></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>' . $lang_block['position'] . '</td>';
        $html .= '<td><select name="config_position" class="form-control" style="width:250px">
            <option value="left"' . ($data_block['position'] == 'left' ? ' selected="selected"' : '') . '>' . $lang_block['position_left'] . '</option>
            <option value="right"' . ($data_block['position'] == 'right' ? ' selected="selected"' : '') . '>' . $lang_block['position_right'] . '</option>
        </select></td>';
        $html .= '</tr>';
        return $html;
    }

    /**
     * nv_block_config_rada_submit()
     * 
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_rada_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['partner'] = $nv_Request->get_int('config_partner', 'post', 11825);
        $return['config']['position'] = $nv_Request->get_title('config_position', 'post', 'left');
        return $return;
    }

    /**
     * nv_block_rada()
     * 
     * @param mixed $block_config
     * @return
     */
    function nv_block_rada($block_config)
    {
        global $my_footer;
        
        if (empty($block_config['partner'])) {
            $block_config['partner'] = 11825;
        }
        if (empty($block_config['position'])) {
            $block_config['position'] = 'left';
        }
        
        $my_footer .= '<script src="http://rada.asia/site/js/rada-1.0.0.js"></script>';
        $my_footer .= '<div class="rada-shortcut" data-partner="' . $block_config['partner'] . '" data-position="' . $block_config['position'] . '"></div>';
        return '<div style="display:none;">&nbsp;</div>';
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_rada($block_config);
}
