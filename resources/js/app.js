require('./bootstrap');
$("#md-content a").each(function () {
    let href = $(this).attr('href');
    if(href !==undefined)
    {
        if (href.indexOf("{{ config('app.url') }}") === -1) {
            $(this).attr('href', "/go-wild?url="+ encodeURIComponent(href));

            $(this).attr('target', '_blank');
        }
    }
});

$('[data-toggle="tooltip"]').tooltip()









class Ghost {

    setClipboardText(event,copyData){
        let clipboardData = event.clipboardData || window.clipboardData;
        if (!clipboardData) { return; }
        event.preventDefault();

        let text = window.getSelection().toString();

        if (text) {
            event.preventDefault();
            let copyright = '\n\n'
                + '\n著作权归作者所有。'
                + '\n商业转载请联系作者获得授权，非商业转载请注明出处。'
                + '\n作者: ' + copyData.author
                + '\n邮箱: ' + copyData.email
                + '\n原文地址: ' + copyData.url

            clipboardData.setData('text/plain', text + copyright);

        }
    }

    comment() {
        let $content = $('#content')
        let $postComment = $content.find('.Post-Comment');
        let res=null
        let commentId;
        let url = $postComment.find('form').attr('action');
        $content.on('click','.Reply',function () {
            let $cardBody = $(this).parents('.card-body');
            commentId = $(this).data('id');
            $postComment.find('form').attr('action',url + '/' + commentId)
            $postComment.remove();
            if(res !==null){
                res.find('.comment').remove()
            }
            res = $cardBody.append($postComment.html())
        })

    }
}

window.Ghost = new Ghost;