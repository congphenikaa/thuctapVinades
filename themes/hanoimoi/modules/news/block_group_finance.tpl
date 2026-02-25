<div class="finance-news-block">
    <ul class="list-unstyled">
        <li class="news-item" style="padding: 15px 0; border-bottom: 1px solid #eee;">
            <div class="row">
                <div class="col-md-8">
                    <a href="{ROW.link}" title="{ROW.title}">
                        <img src="{ROW.thumb}" alt="{ROW.title}" class="img-responsive" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px;">
                    </a>
                </div>
                
                <div class="col-md-16">
                    <h3 class="news-title" style="margin-top: 0; font-size: 18px; line-height: 1.4;">
                        <a href="{ROW.link}" style="color: #222; font-weight: bold; text-decoration: none;">
                            {ROW.title}
                        </a>
                    </h3>
                    
                    <div class="meta text-muted" style="font-size: 12px; margin: 5px 0;">
                        <i class="fa fa-clock-o"></i> {ROW.publtime}
                    </div>
                    
                    <p class="summary" style="color: #555; font-size: 14px; margin-bottom: 0;">
                        {ROW.hometext_clean}
                    </p>
                </div>
            </div>
        </li>
        </ul>
</div>

<style>
    .news-title a:hover { color: #0056b3 !important; }
</style>