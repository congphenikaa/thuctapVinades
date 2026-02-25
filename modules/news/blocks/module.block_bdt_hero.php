<?php

if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

if (!nv_function_exists('nv_news_block_bdt_hero')) {

    // Form cấu hình trong Admin
    function nv_block_config_news_bdt_hero($module, $data_block, $lang_block)
    {
        $numrow = isset($data_block['numrow']) ? $data_block['numrow'] : 6;
        $length_title = isset($data_block['length_title']) ? $data_block['length_title'] : 80;
        $length_hometext = isset($data_block['length_hometext']) ? $data_block['length_hometext'] : 200;

        $html = '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">Số bài hiển thị (Nên để 6):</label>';
        $html .= '  <div class="col-sm-18"><input type="text" class="form-control" name="config_numrow" value="' . $numrow . '"></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">Độ dài tiêu đề:</label>';
        $html .= '  <div class="col-sm-18"><input type="text" class="form-control" name="config_length_title" value="' . $length_title . '"></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">Độ dài đoạn giới thiệu:</label>';
        $html .= '  <div class="col-sm-18"><input type="text" class="form-control" name="config_length_hometext" value="' . $length_hometext . '"></div>';
        $html .= '</div>';

        return $html;
    }

    // Lưu cấu hình Admin
    function nv_block_config_news_bdt_hero_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = [];
        $return['numrow'] = $nv_Request->get_int('config_numrow', 'post', 6);
        $return['length_title'] = $nv_Request->get_int('config_length_title', 'post', 80);
        $return['length_hometext'] = $nv_Request->get_int('config_length_hometext', 'post', 200);
        return $return;
    }

    // Hàm xuất dữ liệu ra giao diện
    function nv_news_block_bdt_hero($block_config)
    {
        global $site_mods, $global_config, $module_file, $db;
        $module = $block_config['module'];

        $block_theme = 'default';
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $module_file . '/block_bdt_hero.tpl')) {
            $block_theme = $global_config['site_theme'];
        }

        $xtpl = new XTemplate('block_bdt_hero.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $module_file);

        $numrow = isset($block_config['numrow']) ? $block_config['numrow'] : 8;
        $length_title = isset($block_config['length_title']) ? $block_config['length_title'] : 80;
        $length_hometext = isset($block_config['length_hometext']) ? $block_config['length_hometext'] : 200;

        $db->sqlreset()
            ->select('id, catid, title, alias, hometext, homeimgfile, homeimgthumb, publtime')
            ->from(NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows')
            ->where('status= 1 AND inhome=1')
            ->order('publtime DESC')
            ->limit($numrow);

        $result = $db->query($db->sql());
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
            $row['hometext'] = nv_clean60(strip_tags($row['hometext']), $length_hometext);

            // Tách tin 1 ra làm tin chính, các tin còn lại vào danh sách
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
    $content = nv_news_block_bdt_hero($block_config);
}
