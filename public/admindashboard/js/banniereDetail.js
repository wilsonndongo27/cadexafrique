/********************* enregistrer un detail sur un service *******************/
$(document).on('click','#AddDetailBanniere', function (e) {
    e.preventDefault();
    $('#AddBanniereDetailModal').modal({backdrop: 'static'});
});

//call modal to crete a new post
$(document).on('click','#updatedetailbanniere', function (e) {
    e.preventDefault();
    var detail_id = $(this).data('detailid');
    var title = $(this).data('title');
    var description = $(this).data('description');
    var photo = $(this).data('photo'); 
    $('#detail_id').val(detail_id);
    $('#titledetailbanniere').val(title);
    $('#detailbannieredesc').val(description);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#post-content1upate').val(description);
    
    $('#phototoupdate').attr('src', photo);
    $('#UpdateDetailBanniereModal').modal({backdrop: 'static'});
});



//call modal to delete a post
$(document).on('click','#deletedetailbanniere', function (e) {
    e.preventDefault();
    var id_object = $(this).data('iddetail');
    $('#iddetail').val(id_object);
    $('#DeleteDetailBanniereModal').modal({backdrop: 'static'});
});



/**
* END BLOCK
*/
