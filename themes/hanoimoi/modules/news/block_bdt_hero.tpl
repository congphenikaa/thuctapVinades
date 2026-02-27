<!-- BEGIN: main -->
<div class="bdt-hero-block">
    <div class="row">
        <!-- Phần Trái: Tin Chính (Chiếm 14/24 cột) -->
        <div class="col-xs-24 col-sm-14 col-md-14">
            <article class="hero-main">
                <a href="{main.link}" title="{main.title}" class="hero-main-link">
                    <!-- Ảnh to -->
                    <img src="{main.imgsource}" alt="{main.title}" class="img-responsive hero-main-img" />
                </a>
                
                <!-- Tiêu đề lớn -->
                <h2 class="hero-main-title">
                    <a href="{main.link}" title="{main.title}">{main.titleclean}</a>
                </h2>
                
                <!-- Đoạn mô tả -->
                <div class="text-muted hero-main-desc">
                    {main.hometext}
                </div>
            </article>
        </div>

        <!-- Phần Giữa: Danh sách tin phụ (Chiếm 10/24 cột) -->
        <div class="col-xs-24 col-sm-10 col-md-10">
            <div class="hero-list">
                
                <!-- Vòng lặp hiển thị các tin dạng danh sách -->
                <!-- BEGIN: othernews -->
                <article class="hero-item">
                    <h3 class="hero-item-title">
                        <a href="{othernews.link}" title="{othernews.title}">{othernews.titleclean}</a>
                    </h3>
                </article>
                <!-- END: othernews -->
                
            </div>
        </div>
    </div>
</div>
<!-- END: main -->