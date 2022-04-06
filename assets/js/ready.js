jQuery(document).ready(function () {
    jQuery('.term-filter-search').change(function () {
        var data = jQuery('#filter').serialize();
        jQuery.ajax({
            url: globalVars.ajaxurl,
            data: data,
            method: 'POST',
            dataType: 'html'
        }).done(function (data) {
            if(data) {
                jQuery(".wrap-courses .row").html(data)
                jQuery(".pagination-wrap").hide();
            }else{
                location.reload();
            }
        }).fail(function (data) {
            console.log('error: '+data);
        });
    });
});