/********************* enregistrer une categorie *******************/
$(document).on('click','#AddCategorie', function (e) {
    e.preventDefault();
    $('#AddCategorieModal').modal({backdrop: 'static'});
});

//call modal to crete a new post
$(document).on('click','#updatecategorie', function (e) {
    e.preventDefault();
    var categorie_id = $(this).data('categorieid');
    var name = $(this).data('name');
    $('#categorie_id').val(categorie_id);
    $('#namecategorie').val(name);
    $('#UpdateCategorieModal').modal({backdrop: 'static'});
});


//call modal to delete a post
$(document).on('click','#deletecategoriemodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idcategorie');
    $('#idcategorie').val(id_object);
    $('#DeleteCategorie').modal({backdrop: 'static'});
});
