<!-- BEGIN: main -->
<!-- BEGIN: loop -->
<div class="nv-block-banners" style="margin-bottom: 15px;">
    <!-- BEGIN: type_image_link -->
    <a rel="nofollow" href="{DATA.link}" onclick="this.target='{DATA.target}'" title="{DATA.file_alt}">
        <!-- Thêm class img-responsive để chống vỡ khung trên điện thoại -->
        <img alt="{DATA.file_alt}" src="{DATA.file_image}" class="img-responsive" style="width: 100%; height: auto;">
    </a>
    <!-- END: type_image_link -->
    
    <!-- BEGIN: type_image -->
    <!-- Thêm class img-responsive để chống vỡ khung -->
    <img alt="{DATA.file_alt}" src="{DATA.file_image}" class="img-responsive" style="width: 100%; height: auto;">
    <!-- END: type_image -->
    
    <!-- BEGIN: bannerhtml -->
    <div class="clearfix text-left">
        {DATA.bannerhtml}
    </div>
    <!-- END: bannerhtml -->
</div>
<!-- END: loop -->
<!-- END: main -->