<!-- BEGIN: main -->
<style>
    /* Bố cục Flexbox để dàn hàng ngang */
    .block-horizontal-layout {
        display: flex;
        flex-wrap: wrap; 
        gap: 20px; 
        padding: 0;
        margin: 0;
    }
    
    .block-horizontal-layout li {
        flex: 1; 
        min-width: 180px; 
        list-style: none; 
    }

    /* ĐỊNH DẠNG ĐỂ CÁC ẢNH CÓ CÙNG KÍCH THƯỚC */
    .block-horizontal-layout .img-wrapper {
        display: block;
        margin-bottom: 10px;
        width: 100%;
        
        /* Cố định tỉ lệ ảnh (Chiều ngang / Chiều dọc). 
           Bạn có thể đổi thành 16/9 (chữ nhật dài) hoặc 1/1 (ảnh vuông) tùy ý */
        aspect-ratio: 4 / 3; 
        
        overflow: hidden; /* Giấu đi phần ảnh bị thừa ra ngoài khung */
        border-radius: 6px; /* Bo tròn góc ảnh một chút cho hiện đại */
    }
    
    .block-horizontal-layout .img-wrapper img {
        width: 100%;
        height: 100%; /* Bắt buộc ảnh phải cao bằng tỷ lệ khung (aspect-ratio) ở trên */
        object-fit: cover; /* Cắt cúp ảnh tự động để lấp đầy khung mà không bị méo */
        transition: transform 0.3s ease; /* Thêm hiệu ứng chuyển động khi di chuột */
    }

    /* Hiệu ứng zoom nhẹ ảnh khi người dùng di chuột vào */
    .block-horizontal-layout .img-wrapper:hover img {
        transform: scale(1.05);
    }

    .block-horizontal-layout .title-link {
        font-weight: 600;
        line-height: 1.4;
        display: block;
        font-size: 15px;
    }
</style>

<ul class="block_groups list-none list-items block-horizontal-layout">
    <!-- BEGIN: loop -->
    <li class="clearfix">
        <!-- BEGIN: img -->
        <a href="{ROW.link}" title="{ROW.title}" {ROW.target_blank} class="img-wrapper">
            <img src="{ROW.thumb}" alt="{ROW.title}" />
        </a>
        <!-- END: img -->
        <a {TITLE} class="show title-link" href="{ROW.link}" {ROW.target_blank} data-content="{ROW.hometext_clean}" data-img="{ROW.thumb}" data-rel="block_tooltip">{ROW.title_clean}</a>
    </li>
    <!-- END: loop -->
</ul>

<!-- BEGIN: tooltip -->
<script type="text/javascript">
$(document).ready(function() {
    $("[data-rel='block_tooltip'][data-content!='']").tooltip({
        placement: "{TOOLTIP_POSITION}",
        html: true,
        title: function(){
            return ( $(this).data('img') == '' ? '' : '<img class="img-thumbnail pull-left margin_image" src="' + $(this).data('img') + '" width="90" />' ) + '<p class="text-justify">' + $(this).data('content') + '</p><div class="clearfix"></div>';
        }
    });
});
</script>
<!-- END: tooltip -->
<!-- END: main -->