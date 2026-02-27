<?php

if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

if (!nv_function_exists('nv_news_block_bdt_gocnhin')) {

    // 1. Hàm tạo form cấu hình trong Admin
    function nv_block_config_news_bdt_gocnhin($module, $data_block, $lang_block)
    {
        $numrow = isset($data_block['numrow']) ? $data_block['numrow'] : 4;
        $length_title = isset($data_block['length_title']) ? $data_block['length_title'] : 80;

        $html = '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">Số bài hiển thị (Ví dụ: 4):</label>';
        $html .= '  <div class="col-sm-18"><input type="text" class="form-control" name="config_numrow" value="' . $numrow . '"></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">Độ dài tiêu đề:</label>';
        $html .= '  <div class="col-sm-18"><input type="text" class="form-control" name="config_length_title" value="' . $length_title . '"></div>';
        $html .= '</div>';

        return $html;
    }

    // 2. Hàm lưu cấu hình vào Database (Đã bọc trong mảng config)
    function nv_block_config_news_bdt_gocnhin_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = [];
        $return['error'] = [];
        $return['config'] = [];
        $return['config']['numrow'] = $nv_Request->get_int('config_numrow', 'post', 4);
        $return['config']['length_title'] = $nv_Request->get_int('config_length_title', 'post', 80);
        return $return;
    }

    // 3. Hàm truy vấn và xuất dữ liệu ra giao diện
    function nv_news_block_bdt_gocnhin($block_config)
    {
        global $site_mods, $global_config, $module_file, $db;
        $module = $block_config['module'];

        $block_theme = 'default';
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $module_file . '/block_bdt_gocnhin.tpl')) {
            $block_theme = $global_config['site_theme'];
        }

        $xtpl = new XTemplate('block_bdt_gocnhin.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $module_file);

        $numrow = isset($block_config['numrow']) ? $block_config['numrow'] : 4;
        $length_title = isset($block_config['length_title']) ? $block_config['length_title'] : 80;

        // Câu lệnh SQL lấy dữ liệu
        $sql = 'SELECT id, catid, title, alias, homeimgfile, homeimgthumb, publtime '
            . 'FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows '
            . 'WHERE status= 1 AND inhome=1 '
            . 'ORDER BY publtime DESC '
            . 'LIMIT ' . $numrow;

        $result = $db->query($sql);
        $i = 1;

        while ($row = $result->fetch()) {
            $row['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $row['catid'] . '/' . $row['alias'] . '-' . $row['id'] . $global_config['rewrite_exturl'];

            // Cấu hình đường dẫn ảnh
            if ($row['homeimgthumb'] == 1 || $row['homeimgthumb'] == 2) {
                $row['imgsource'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/' . $row['homeimgfile'];
            } elseif ($row['homeimgthumb'] == 3) {
                $row['imgsource'] = $row['homeimgfile'];
            } else {
                $row['imgsource'] = NV_STATIC_URL . 'themes/' . $global_config['site_theme'] . '/images/no_image.gif';
            }

            $row['titleclean'] = nv_clean60($row['title'], $length_title);

            // Phân loại: Bài đầu tiên (main), các bài sau (othernews)
            if ($i == 1) {
                $xtpl->assign('main', $row);
            } else {
                $xtpl->assign('othernews', $row);
                $xtpl->parse('main.othernews'); // Lệnh này yêu cầu XTemplate lặp lại block othernews
            }
            $i++;
        }

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

// Thực thi block
if (defined('NV_SYSTEM')) {
    $content = nv_news_block_bdt_gocnhin($block_config);
}
