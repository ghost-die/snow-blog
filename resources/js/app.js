require('./bootstrap');
$("#md-content a").each(function () {
    let href = $(this).attr('href');
    if(href !==undefined)
    {
        if (href.indexOf("{{ config('app.url') }}") === -1) {
            $(this).attr('href', "/go-wild?url="+ encodeURIComponent(href));
        }
    }
});

$('[data-toggle="tooltip"]').tooltip()
