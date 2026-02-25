<!-- BEGIN: tree -->
<li>
    <a title="{MENUTREE.note}" href="{MENUTREE.link}" {MENUTREE.target}>{MENUTREE.title_trim}</a>
    <!-- BEGIN: tree_content -->
    <ul class="bdt-sub-menu">
        {TREE_CONTENT}
    </ul>
    <!-- END: tree_content -->
</li>
<!-- END: tree -->

<!-- BEGIN: main -->
<nav class="bdt-main-menu">
    <ul class="bdt-menu-list">
        <!-- Nút Trang chủ cố định -->
        <li class="home-icon"><a href="{THEME_SITE_HREF}" title="{LANG.Home}"><i class="fa fa-home"></i></a></li>
        
        <!-- BEGIN: loopcat1 -->
        <li>
            <a href="{CAT1.link}" {CAT1.target} title="{CAT1.note}">
                {CAT1.title_trim}
                <!-- BEGIN: cat2 -->
                <i class="fa fa-angle-down" style="margin-left:5px; font-size:12px;"></i>
                <!-- END: cat2 -->
            </a>
            
            <!-- BEGIN: cat2 -->
            <ul class="bdt-sub-menu">
                {HTML_CONTENT}
            </ul>
            <!-- END: cat2 -->
        </li>
        <!-- END: loopcat1 -->
    </ul>
    
    <!-- Các công cụ bên phải (Tìm kiếm, Menu mở rộng) -->
    <div class="bdt-menu-tools hidden-xs">
        <a href="{NV_BASE_SITEURL}index.php?nv=seek" title="Tìm kiếm"><i class="fa fa-search"></i></a>
        <a href="#" title="Menu mở rộng"><i class="fa fa-bars"></i></a>
    </div>
</nav>
<!-- END: main -->