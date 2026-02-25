<?php

if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

if (!nv_function_exists('nv_block_bdt_menu')) {

    // 1. Hàm tạo Form tùy chọn trong trang Quản trị (Admin)
    function nv_block_config_bdt_menu($module, $data_block, $lang_block)
    {
        global $db;
        $html = '';

        // Lấy danh sách các Menu đã được người dùng tạo trong phần "Menu site"
        $sql = "SELECT id, title FROM " . NV_PREFIXLANG . "_menu_site ORDER BY id DESC";
        $result = $db->query($sql);

        $menuid = isset($data_block['menuid']) ? $data_block['menuid'] : 0;

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">Chọn Menu hiển thị</label>';
        $html .= '<div class="col-sm-18"><select name="config_menuid" class="form-control">';
        while ($row = $result->fetch()) {
            $sel = ($menuid == $row['id']) ? ' selected="selected"' : '';
            $html .= '<option value="' . $row['id'] . '"' . $sel . '>' . $row['title'] . '</option>';
        }
        $html .= '</select></div></div>';

        return $html;
    }

    // 2. Hàm lưu tùy chọn từ Admin
    function nv_block_config_bdt_menu_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = [];
        $return['menuid'] = $nv_Request->get_int('config_menuid', 'post', 0);
        return $return;
    }

    // 3. Hàm đệ quy xử lý các menu con (cấp 2, cấp 3...)
    function nv_block_bdt_menu_parse_tree($xtpl, $menu_data, $parentid)
    {
        $html = '';
        if (isset($menu_data[$parentid])) {
            foreach ($menu_data[$parentid] as $item) {
                $xtpl->assign('MENUTREE', $item);

                // Nếu có menu con tiếp (Cấp 3 trở lên), gọi lại chính hàm này
                if (isset($menu_data[$item['id']])) {
                    $xtpl->assign('TREE_CONTENT', nv_block_bdt_menu_parse_tree($xtpl, $menu_data, $item['id']));
                    $xtpl->parse('tree.tree_content');
                }

                $xtpl->parse('tree');
                $html .= $xtpl->text('tree');
                $xtpl->reset('tree');
            }
        }
        return $html;
    }

    // 4. Hàm xuất giao diện chính ra Website
    function nv_block_bdt_menu($block_config)
    {
        global $global_config, $db;

        $menuid = isset($block_config['menuid']) ? $block_config['menuid'] : 0;
        if ($menuid == 0) return ''; // Nếu chưa chọn menu thì không hiển thị

        // Ưu tiên load file TPL từ thư mục giao diện hiện tại
        $block_theme = 'default';
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/menu/block_bdt_menu.tpl')) {
            $block_theme = $global_config['site_theme'];
        }

        $xtpl = new XTemplate('block_bdt_menu.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/menu');
        $xtpl->assign('LANG', $global_config['site_lang']);
        $xtpl->assign('THEME_SITE_HREF', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA);
        $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);

        // Truy xuất toàn bộ dữ liệu của Menu được chọn
        $sql = "SELECT id, parentid, title, link, note, target FROM " . NV_PREFIXLANG . "_menu_rows WHERE menu_id=" . $menuid . " AND status=1 ORDER BY weight ASC";
        $result = $db->query($sql);

        $menu_data = [];
        while ($row = $result->fetch()) {
            $menu_data[$row['parentid']][] = [
                'id' => $row['id'],
                'parentid' => $row['parentid'],
                'title_trim' => $row['title'],
                'link' => $row['link'],
                'note' => $row['note'],
                'target' => $row['target']
            ];
        }

        // Bắt đầu duyệt cấp 1 (parentid = 0)
        if (isset($menu_data[0])) {
            foreach ($menu_data[0] as $cat1) {
                $xtpl->assign('CAT1', $cat1);

                // Nếu mục cấp 1 này có chứa menu con
                if (isset($menu_data[$cat1['id']])) {
                    // Xử lý nhánh menu con và truyền vào {HTML_CONTENT}
                    $html_content = nv_block_bdt_menu_parse_tree($xtpl, $menu_data, $cat1['id']);
                    $xtpl->assign('HTML_CONTENT', $html_content);

                    // Bật block cat2 để TPL hiển thị mũi tên và thẻ <ul> con
                    $xtpl->parse('main.loopcat1.cat2');
                }

                $xtpl->parse('main.loopcat1');
            }
        }

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_bdt_menu($block_config);
}
