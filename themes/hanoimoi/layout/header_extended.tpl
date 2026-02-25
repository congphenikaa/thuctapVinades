<!-- BẮT ĐẦU: KHỐI HEADER BÁO ĐẦU TƯ (ĐỘNG TỪ CSDL) -->
<div class="container bdt-header-wrapper">
    
    <!-- 1. KHỐI BANNER QUẢNG CÁO TRÊN CÙNG (Lấy từ Block) -->
    <div class="row bdt-top-ad">
        <div class="col-xs-24 col-sm-24 col-md-24">
            [HEADER_BANNER]
        </div>
    </div>

    <!-- 2. KHỐI LOGO Ở GIỮA (Tự động lấy cấu hình từ Admin -> Cấu hình chung) -->
    <div class="row">
        <div class="col-xs-24 col-sm-24 col-md-24 bdt-logo-wrap">
            <a href="{THEME_SITE_HREF}" title="{SITE_NAME}">
                <img src="{LOGO_SRC}" alt="{SITE_NAME}" style="max-height: 80px;">
            </a>
        </div>
    </div>

    <!-- 3. THANH THÔNG TIN (NGÀY THÁNG & MẠNG XÃ HỘI) -->
    <div class="row bdt-top-bar">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="bdt-date-time">
                <!-- BEGIN: currenttime -->{NV_CURRENTTIME}<!-- END: currenttime -->
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="bdt-social-links">
                <a href="#" class="fa fa-facebook" title="Facebook"></a>
                <a href="#" class="fa fa-twitter" title="Twitter"></a>
                <a href="#" class="fa fa-rss" title="RSS"></a>
            </div>
        </div>
    </div>

    <!-- 4. THANH MENU CHÍNH -->
    <div class="row">
        <div class="col-xs-24 col-sm-24 col-md-24">
            <!-- Toàn bộ khung giao diện Menu đã được xử lý bên trong Block -->
            [HEADER_MENU]
        </div>
    </div>
    
    [THEME_ERROR_INFO]
</div>
<!-- KẾT THÚC: KHỐI HEADER BÁO ĐẦU TƯ -->