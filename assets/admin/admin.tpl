<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Categories", 'gallery')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button class="btn btn-small btn-danger disabled action_on" id="del_in_search" onclick="$('.products_delete_dialog').modal();" disabled="disabled"><i class="icon-trash"></i>{lang("Delete", 'gallery')}</button>
                <a href="/admin/components/init_window/gallery/show_create_category" class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i>{lang("Create a category", 'gallery')}</a>
                <a href="/admin/components/init_window/gallery/show_crate_album" class="btn btn-small pjax btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang("Create an album", 'gallery')}</a>
                <a href="/admin/components/cp/gallery/settings" class="btn btn-small pjax">{lang("Settings", 'gallery')}</a>
            </div>
        </div>
    </div>
    {if $content}
        {$content}
    {else:}
        <div class="alert alert-info m-t_20">
            {lang("No content", 'gallery')}
        </div>
    {/if}
</section>