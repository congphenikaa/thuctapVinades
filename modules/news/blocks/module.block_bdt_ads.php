<?php

if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

if (!nv_function_exists('nv_block_bdt_ads')) {

    // Form nhập liệu trong Admin NukeViet
    function nv_block_config_bdt_ads($module, $data_block, $lang_block)
    {
        $image_url = isset($data_block['image_url']) ? $data_block['image_url'] : '';
        $ad_link = isset($data_block['ad_link']) ? $data_block['ad_link'] : '';
        $ad_alt = isset($data_block['ad_alt']) ? $data_block['ad_alt'] : '';

        // Tích hợp nút Browse Image của NukeViet
        $html = '<div class="form-group">';
        $html .= '  <label class="col-sm-6 control-label">Hình ảnh quảng cáo:</label>';
        $html .= '  <div class="col-sm-18">';
        $html .= '      <div class="input-group">';
        $html .= '          <input type="text" class="form-control" name="config_image_url" id="config_image_url" value="' . $image_url . '" placeholder="Bấm nút bên cạnh để chọn ảnh ->">';
        $html .= '          <span class="input-group-btn">';
        $html .= '              <button class="btn btn-primary" type="button" onclick="nv_open_browse(\'' . NV_BASE_ADMINURL . 'index.php?nv=upload&popup=1&area=config_image_url&path=uploads&type=image\', \'NVImg\', 850, 420, \'resizable=no,scrollbars=no,toolbar=no,location=no,status=no\'); return false;">';
        $html .= '                  <i class="fa fa-folder-open-o"></i> Chọn ảnh';
        $html .= '              </button>';
        $html .= '          </span>';
        $html .= '      </div>';
        $html .= '  </div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '  <label class="col-sm-6 control-label">Đường dẫn khi click (Link):</label>';
        $html .= '  <div class="col-sm-18"><input type="text" class="form-control" name="config_ad_link" value="' . $ad_link . '" placeholder="Ví dụ: https://mof.gov.vn"></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '  <label class="col-sm-6 control-label">Chú thích (Alt - tốt cho SEO):</label>';
        $html .= '  <div class="col-sm-18"><input type="text" class="form-control" name="config_ad_alt" value="' . $ad_alt . '"></div>';
        $html .= '</div>';

        return $html;
    }

    // Lưu cấu hình an toàn
    function nv_block_config_bdt_ads_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = [];
        $return['image_url'] = $nv_Request->get_string('config_image_url', 'post', '');
        $return['ad_link'] = $nv_Request->get_string('config_ad_link', 'post', '');
        $return['ad_alt'] = $nv_Request->get_string('config_ad_alt', 'post', '');
        return $return;
    }

    // Xuất ra giao diện TPL
    function nv_block_bdt_ads($block_config)
    {
        global $global_config, $module_file;

        $block_theme = 'default';
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/news/block_bdt_ads.tpl')) {
            $block_theme = $global_config['site_theme'];
        }

        $xtpl = new XTemplate('block_bdt_ads.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/news');

        $image_url = isset($block_config['image_url']) ? $block_config['image_url'] : '';

        // Xử lý đường dẫn ảnh tự động
        if (!empty($image_url) && !preg_match("/^(http|https|\/\/)/", $image_url)) {
            if (strpos($image_url, NV_BASE_SITEURL) !== 0) {
                $image_url = NV_BASE_SITEURL . ltrim($image_url, '/');
            }
        }

        // Ảnh mặc định nếu bỏ trống
        if (empty($image_url)) {
            $image_url = NV_BASE_SITEURL . 'themes/' . $global_config['site_theme'] . '/images/no_image.gif';
        }

        $ad_link = !empty($block_config['ad_link']) ? $block_config['ad_link'] : 'javascript:void(0);';
        $ad_alt = !empty($block_config['ad_alt']) ? $block_config['ad_alt'] : 'Quảng cáo';

        $xtpl->assign('IMAGE_URL', $image_url);
        $xtpl->assign('AD_LINK', $ad_link);
        $xtpl->assign('AD_ALT', $ad_alt);

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_bdt_ads($block_config);
}
