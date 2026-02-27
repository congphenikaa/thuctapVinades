<!-- BEGIN: main -->
<div class="bdt-magazine-block">
    <div class="row bdt-magazine-row">
        
        <!-- ================= BÊN TRÁI: 1 BÀI LỚN CHỮ ĐÈ TRONG ẢNH ================= -->
        <!-- Chiếm 12/24 cột (50%) -->
        <div class="col-xs-24 col-sm-24 col-md-12 magazine-main-wrapper">
            <article class="magazine-main">
                <a href="{main.link}" title="{main.title}" class="magazine-main-link">
                    <!-- Ảnh full màn, tự động cắt cúp -->
                    <img src="{main.imgsource}" alt="{main.title}" class="img-responsive magazine-main-img">
                    
                    <!-- Lớp phủ màu đen Gradient từ dưới lên -->
                    <div class="magazine-main-overlay"></div>
                </a>

                <!-- Nội dung chữ nổi lên trên -->
                <div class="magazine-main-content">
                    <h2 class="magazine-main-title">
                        <a href="{main.link}" title="{main.title}">{main.titleclean}</a>
                    </h2>
                </div>
            </article>
        </div>

        <!-- ================= BÊN PHẢI: 4 BÀI NHỎ CHIA 2 CỘT ================= -->
        <!-- Chiếm 12/24 cột (50%) -->
        <div class="col-xs-24 col-sm-24 col-md-12">
            <!-- Row con bên trong để chia lưới 2x2 -->
            <div class="row bdt-magazine-sub-row">
                
                <!-- BEGIN: othernews -->
                <!-- Mỗi bài nhỏ chiếm 12/24 của cột con -->
                <div class="col-xs-12 col-sm-12 col-md-12 magazine-item-wrapper">
                    <article class="magazine-item">
                        <a href="{othernews.link}" title="{othernews.title}" class="magazine-item-link">
                            <img src="{othernews.imgsource}" alt="{othernews.title}" class="img-responsive magazine-item-img">
                        </a>
                        <h3 class="magazine-item-title">
                            <a href="{othernews.link}" title="{othernews.title}">{othernews.titleclean}</a>
                        </h3>
                    </article>
                </div>
                <!-- END: othernews -->
                
            </div>
        </div>

    </div>
</div>
<!-- END: main -->