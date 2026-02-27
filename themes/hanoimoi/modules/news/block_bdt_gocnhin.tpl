<!-- BEGIN: main -->
<div class="bdt-gocnhin-block" style="margin-bottom: 30px; background: #f8f9fa; padding: 15px;">
    <div class="row">
        <!-- Phần Trái: Tin Chính (Bài số 1) -->
        <div class="col-xs-24 col-sm-16 col-md-16">
            <article class="gocnhin-main" style="margin-bottom: 20px;">
                <a href="{main.link}" title="{main.title}" style="display: block; overflow: hidden; margin-bottom: 12px;">
                    <img src="{main.imgsource}" alt="{main.title}" class="img-responsive" style="width: 100%; object-fit: cover; aspect-ratio: 16/10;">
                </a>
                <h2 style="margin: 0; font-size: 24px; font-weight: bold; line-height: 1.4;">
                    <a href="{main.link}" title="{main.title}" style="color: #222; text-decoration: none;">{main.titleclean}</a>
                </h2>
            </article>
        </div>

        <!-- Phần Phải: Danh sách tin phụ (Bài số 2, 3, 4...) -->
        <div class="col-xs-24 col-sm-8 col-md-8">
            <div class="gocnhin-list" style="display: flex; flex-direction: column; gap: 20px; height: 100%;">
                
                <!-- BEGIN: othernews -->
                <article class="gocnhin-item">
                    <a href="{othernews.link}" title="{othernews.title}" style="display: block; overflow: hidden; margin-bottom: 8px;">
                        <img src="{othernews.imgsource}" alt="{othernews.title}" class="img-responsive" style="width: 100%; object-fit: cover; aspect-ratio: 16/10;">
                    </a>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700; line-height: 1.3;">
                        <a href="{othernews.link}" title="{othernews.title}" style="color: #333; text-decoration: none;">{othernews.titleclean}</a>
                    </h3>
                </article>
                <!-- END: othernews -->
                
            </div>
        </div>
    </div>
</div>
<!-- END: main -->