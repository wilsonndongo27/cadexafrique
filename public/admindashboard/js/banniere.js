// enregistrer un slide
$(document).on('click','#AddSlideImage', function (e) {
    e.preventDefault();
    $('#AddSlideModal').modal({backdrop: 'static'});
});

//call modal to crete a new post
$(document).on('click','#updateslide', function (e) {
    e.preventDefault();
    var slide_id = $(this).data('slideid');
    var title = $(this).data('title');
    var labeldesc = $(this).data('labeldesc');
    var description = $(this).data('description');
    var type = $(this).data('typeslide');
    var photo = $(this).data('photo');
    $('#slide_id').val(slide_id);
    $('#titleslide').val(title);
    $('#labeldescslide').val(labeldesc);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#post-content1upate').val(description);

    $('#typeslide').text(type);
    $('#phototoupdate').attr('src', photo);
    $('#UpdateSlide').modal({backdrop: 'static'});
});

//call modal to delete a post
$(document).on('click','#deletemodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idslide');
    $('#idslide').val(id_object);
    $('#DeleteSlideImage').modal({backdrop: 'static'});
});


