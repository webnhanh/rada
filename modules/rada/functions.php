<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 10/03/2010 10:51
 */

if (!defined('NV_SYSTEM')) {
    die('Stop!!!');
}

define('NV_IS_MOD_RADA', true);

/**
 * imgRadaProcess()
 * 
 * @param mixed $m
 * @return
 */
function imgRadaProcess($m)
{
    global $module_upload;
    
    $m[2] = ltrim(str_replace('\\', '/', $m[2]), '/');
    $m[2] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $m[2];
    if (!nv_is_file($m[2], NV_UPLOADS_DIR . '/' . $module_upload)) {
        return $m[0];
    }
    return '<img' . $m[1] . 'src="' . $m[2] . '"' . $m[3] . '>';
}

/**
 * linkRadaProcess()
 * 
 * @param mixed $m
 * @return
 */
function linkRadaProcess($m)
{
    global $module_upload, $module_name;
    
    $m[2] = basename(ltrim(str_replace('\\', '/', $m[2]), '/'));
    if (!nv_is_file(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $m[2], NV_UPLOADS_DIR . '/' . $module_upload) or !preg_match("/[\/]*([a-zA-Z0-9\-\.]+)$/i", $m[2])) {
        return $m[0];
    }
    $m[2] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $m[2];
    return '<a' . $m[1] . 'href="' . $m[2] . '"' . $m[3] . '>';
}
