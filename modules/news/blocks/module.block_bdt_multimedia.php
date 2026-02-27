<?php

if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

if (!nv_function_exists('nv_news_block_global_bdt_magazine')) {

    function nv_block_config_news_global_bdt_magazine($module, $data_block, $lang_block)
    {
        $numrow = isset($data_block['numrow']) ? $data_block['numrow'] : 5;
        $length_title = isset($data_block['length_title']) ? $data_block['length_title'] : 80;

        $html = '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">Số bài hiển thị (BẮT BUỘC ĐỂ 5):</label>';
        $html .= '  <div class="col-sm-18"><input type="text" class="form-control" name="config_numrow" value="' . $numrow . '"></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">Độ dài tiêu đề:</label>';
        $html .= '  <div class="col-sm-18"><input type="text" class="form-control" name="config_length_title" value="' . $length_title . '"></div>';
        $html .= '</div>';

        return $html;
    }

    function nv_block_config_news_global_bdt_magazine_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = [];
        $return['error'] = [];
        $return['config'] = [];
        $return['config']['numrow'] = $nv_Request->get_int('config_numrow', 'post', 5);
        $return['config']['length_title'] = $nv_Request->get_int('config_length_title', 'post', 80);
        return $return;
    }

    function nv_news_block_global_bdt_magazine($block_config)
    {
        global $site_mods, $global_config, $module_file, $db;
        $module = $block_config['module'];

        $block_theme = 'default';
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $module_file . '/block_bdt_magazine.tpl')) {
            $block_theme = $global_config['site_theme'];
        }

        $xtpl = new XTemplate('block_bdt_magazine.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $module_file);

        $numrow = isset($block_config['numrow']) ? $block_config['numrow'] : 5;
        $length_title = isset($block_config['length_title']) ? $block_config['length_title'] : 80;

        $sql = 'SELECT id, catid, title, alias, homeimgfile, homeimgthumb, publtime '
            . 'FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows '
            . 'WHERE status= 1 AND inhome=1 '
            . 'ORDER BY publtime DESC '
            . 'LIMIT ' . $numrow;

        $result = $db->query($sql);
        $i = 1;

        while ($row = $result->fetch()) {
            $row['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $row['catid'] . '/' . $row['alias'] . '-' . $row['id'] . $global_config['rewrite_exturl'];

            if ($row['homeimgthumb'] == 1 || $row['homeimgthumb'] == 2) {
                $row['imgsource'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/' . $row['homeimgfile'];
            } elseif ($row['homeimgthumb'] == 3) {
                $row['imgsource'] = $row['homeimgfile'];
            } else {
                $row['imgsource'] = NV_STATIC_URL . 'themes/' . $global_config['site_theme'] . '/images/no_image.gif';
            }

            $row['titleclean'] = nv_clean60($row['title'], $length_title);

            // Bài số 1 ra khối bên trái, bài 2-3-4-5 ra khối bên phải
            if ($i == 1) {
                $xtpl->assign('main', $row);
            } else {
                $xtpl->assign('othernews', $row);
                $xtpl->parse('main.othernews');
            }
            $i++;
        }

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_news_block_global_bdt_magazine($block_config);
}
