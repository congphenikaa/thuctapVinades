<!-- BEGIN: main -->
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