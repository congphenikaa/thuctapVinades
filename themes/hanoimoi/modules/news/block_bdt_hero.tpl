<!-- BEGIN: main -->
<div class="bdt-hero-block" style="margin-bottom: 30px;">
    <div class="row">
        <!-- Phần Trái: Tin Chính (Chiếm 14/24 cột) -->
        <div class="col-xs-24 col-sm-14 col-md-14">
            <article class="hero-main" style="padding-right: 15px;">
                <a href="{main.link}" title="{main.title}" style="display: block; margin-bottom: 15px; overflow: hidden;">
                    <!-- Ảnh to -->
                    <img src="{main.imgsource}" alt="{main.title}" class="img-responsive" style="width: 100%; aspect-ratio: 16/10; object-fit: cover; transition: transform 0.3s ease;" />
                </a>
                
                <!-- Tiêu đề lớn -->
                <h2 style="margin-top: 0; margin-bottom: 12px; font-size: 26px; font-weight: bold; line-height: 1.3;">
                    <a href="{main.link}" title="{main.title}" style="color: #222; text-decoration: none;">{main.titleclean}</a>
                </h2>
                
                <!-- Đoạn mô tả -->
                <div class="text-muted" style="font-size: 15px; line-height: 1.6; text-align: justify; color: #555;">
                    {main.hometext}
                </div>
            </article>
        </div>

        <!-- Phần Giữa: Danh sách tin phụ (Chiếm 10/24 cột) -->
        <div class="col-xs-24 col-sm-10 col-md-10">
            <div class="hero-list" style="padding-left: 15px; border-left: 1px solid #e5e5e5; height: 100%;">
                
                <!-- Vòng lặp hiển thị các tin dạng danh sách -->
                <!-- BEGIN: othernews -->
                <article style="padding-bottom: 12px; margin-bottom: 12px; border-bottom: 1px dashed #e5e5e5;">
                    <h3 style="margin: 0; font-size: 16px; font-weight: bold; line-height: 1.4;">
                        <a href="{othernews.link}" title="{othernews.title}" style="color: #333; text-decoration: none;">
                            {othernews.titleclean}
                        </a>
                    </h3>
                </article>
                <!-- END: othernews -->
                
            </div>
        </div>
    </div>
</div>
<!-- END: main -->