<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Apr 20, 2010 10:47:41 AM
 */

if (!defined('NV_IS_MOD_RADA')) {
    die('Stop!!!');
}

$allowed_path = NV_UPLOADS_DIR . '/' . $module_upload;
if (!empty($array_op[0])) {
    $file_path = NV_UPLOADS_DIR . '/' . $module_upload . '/' . $array_op[0] . '.html';
} else {
    $file_path = NV_UPLOADS_DIR . '/' . $module_upload . '/index.html';
}

if (!nv_is_file(NV_BASE_SITEURL . $file_path, $allowed_path)) {
    nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'], 404);
}

$page_title = $module_info['custom_title'];

$contents = file_get_contents(NV_ROOTDIR . '/' . $file_path);

// Xác định tiêu đề site
if (preg_match("/\<title[^\>]*\>(.*?)\<\/title\>/is", $contents, $m)) {
    $m = trim($m[1]);
    if (!empty($m)) {
        $page_title = $m;
    }
}
// Cắt lấy phần BODY
if (preg_match("/\<body[^\>]*\>(.*?)\<\/body\>/is", $contents, $m)) {
    $m = trim($m[1]);
    $contents = $m;
}

// Xử lý link
$contents = preg_replace_callback("/\<a([^\>]*)href=\"([^\"]*)\"([^\>]*)\>/is", "linkRadaProcess", $contents);

// Xử lý ảnh
$contents = preg_replace_callback("/\<img([^\>]*)src=\"([^\"]*)\"([^\>]*)\>/is", "imgRadaProcess", $contents);
$contents = preg_replace_callback("/\<img([^\>]*)src='([^']*)'([^\>]*)\>/is", "imgRadaProcess", $contents);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
