/********************* enregistrer un service *******************/
$(document).on('click','#AddService', function (e) {
    e.preventDefault();
    $('#AddServiceModal').modal({backdrop: 'static'});
});

//call modal to crete a new post
$(document).on('click','#updateservice', function (e) {
    e.preventDefault();
    var service_id = $(this).data('serviceid');
    var title = $(this).data('title');
    var label = $(this).data('label');
    var description = $(this).data('description');
    var photo = $(this).data('photo');
    $('#service_id').val(service_id);
    $('#titleservice').val(title);
    $('#labelDescService').val(label);
    $('#servicedesc').val(description);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#post-content1upate').val(description);

    $('#phototoupdate').attr('src', photo);
    $('#UpdateServiceModal').modal({backdrop: 'static'});
});



//call modal to delete a post
$(document).on('click','#deleteservicemodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idservice');
    $('#idservice').val(id_object);
    $('#DeleteService').modal({backdrop: 'static'});
});

/**
* END BLOCK
*/
