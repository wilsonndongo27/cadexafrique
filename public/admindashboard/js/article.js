/********************* enregistrer un service *******************/
$(document).on('click','#AddArticle', function (e) {
    e.preventDefault();
    $('#AddArticleModal').modal({backdrop: 'static'});
});

//call modal to crete a new post
$(document).on('click','#updatearticle', function (e) {
    e.preventDefault();
    var service_id = $(this).data('articleid');
    var title = $(this).data('title');
    var label = $(this).data('label');
    var description = $(this).data('description');
    var photo = $(this).data('photo');
    $('#article_id').val(service_id);
    $('#titlearticle').val(title);
    $('#labelDescArticle').val(label);
    $('#articledesc').val(description);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#post-content-update').val(description);

    $('#phototoupdatearticle').attr('src', photo);
    $('#UpdateArticleModal').modal({backdrop: 'static'});
});


//call modal to delete a post
$(document).on('click','#deletearticlemodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idarticle');
    $('#idarticle').val(id_object);
    $('#DeleteArticle').modal({backdrop: 'static'});
});


/** Activate  and deactivate admin  */
$(document).on('click', '#changestatusarticle', function (e) {
    var url = $(this).data('url');
    var statusvalue = $(this).data('statusvalue');
    var currentarticle = $(this).data('currentarticle');
    var token = $(this).data('csrf');
    $.ajax({
        type: 'post',
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: 'statusvalue='+statusvalue+'&currentarticle='+currentarticle,
        datatype: 'json',
        beforeSend: function () {
            $(document.body).css({'cursor' : 'wait'});
            $('.loader').removeClass('hideloader').addClass('showloader');
        },
        success: function (json) {
            $('.blockbutton').empty();
            if (json.etat == 1){
                console.log(json)
                var newstatus = json.status
                if(newstatus == 1){
                    $('.blockbutton').append(`
                        <a href="JavaScript:void()" id="changestatus"
                            data-valuestatus="`+newstatus+`"
                            data-url="`+url+`"
                            data-currentadmin="`+currentarticle+`"
                            data-csrf="`+token+`">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </a>
                    `)
                }else{
                    $('.blockbutton').append(`
                        <a href="JavaScript:void()" id="changestatus"
                            data-valuestatus="`+newstatus+`"
                            data-url="`+url+`"
                            data-currentadmin="`+currentarticle+`"
                            data-csrf="`+token+`">
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </a>
                    `)
                }

                console.log('tous cest bien passer');
            }
        },
        complete: function () {
            $(document.body).css({'cursor' : 'default'});
            $('.loader').removeClass('showloader').addClass('hideloader');
        },
    });
});

function selection(id, name){
    console.log(id, name)
    var option = document.getElementById('option-service-'+id);
    var testSelection = option.getAttribute("selected");
    if(testSelection == null){
        html = document.createElement('option');
        html.setAttribute('id', 'option-service-'+id);
        html.setAttribute('value', id);
        html.setAttribute('selected', "selected")
        html.innerHTML = name;
        option.replaceWith(html)
    }else{
        html = document.createElement('option');
        html.setAttribute('id', 'option-service-'+id);
        html.setAttribute('value', id);
        html.innerHTML = name;
        option.replaceWith(html)
    }
}


/**
* END BLOCK
*/
