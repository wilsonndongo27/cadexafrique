/********************* enregistrer un service *******************/
$(document).on('click','#AddSol', function (e) {
    e.preventDefault();
    $('#AddSolModal').modal({backdrop: 'static'});
});

//call modal to crete a new post
$(document).on('click','#updatesolution', function (e) {
    e.preventDefault();
    var solution_id = $(this).data('idsolution');
    var name = $(this).data('name');
    var label = $(this).data('label');
    var description = $(this).data('description');
    var categorie = $(this).data('categorie');
    var photo = $(this).data('photo');
    $('#solution_id').val(solution_id);
    $('#namesolution').val(name);
    $('#idlabel').val(label);
    $('#namesolutiontitle').text(categorie);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#post-content1upate').val(description);

    $('#categoriesolution').val(categorie);
    $('#phototoupdate').attr('src', photo);
    $('#UpdateSolutionModal').modal({backdrop: 'static'});
});



//call modal to delete a post
$(document).on('click','#deletesolutionmodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idsolution');
    $('#idsolutiondelete').val(id_object);
    $('#DeleteSolution').modal({backdrop: 'static'});
});

/**
* END BLOCK
*/
