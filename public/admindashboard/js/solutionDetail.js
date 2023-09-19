/********************* enregistrer un detail sur un service *******************/
$(document).on('click','#AddDetailSolution', function (e) {
    e.preventDefault();
    $('#AddSDetailSolutionModal').modal({backdrop: 'static'});
});

//call modal to crete a new post
$(document).on('click','#updatedetailsolution', function (e) {
    e.preventDefault();
    var detail_id = $(this).data('detailid');
    var title = $(this).data('title');
    var description = $(this).data('description');
    var photo = $(this).data('photo');
    $('#detail_id').val(detail_id);
    $('#titledetailsolution').val(title);
    $('#detailsolutiondesc').val(description);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#post-content1upate').val(description);
    
    $('#phototoupdate').attr('src', photo);
    $('#UpdateDetailSolutionModal').modal({backdrop: 'static'});
});



//call modal to delete a post
$(document).on('click','#deletedetailsolution', function (e) {
    e.preventDefault();
    var id_object = $(this).data('iddetail');
    $('#iddetail').val(id_object);
    $('#DeleteDetailSolutionModal').modal({backdrop: 'static'});
});


/**
* END BLOCK
*/
