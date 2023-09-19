/********************* enregistrer une categorie *******************/
$(document).on('click','#AddCategorieSolution', function (e) {
    e.preventDefault();
    $('#AddCategorieSolutionModal').modal({backdrop: 'static'});
});

//call modal to crete a new post
$(document).on('click','#updatecategoriesolution', function (e) {
    e.preventDefault();
    var categorie_id = $(this).data('categorieid');
    var name = $(this).data('name');
    $('#categorie_id').val(categorie_id);
    $('#namecategorie').val(name);
    $('#UpdateCategorieSolutionModal').modal({backdrop: 'static'});
});


//call modal to delete a post
$(document).on('click','#deletecategoriesolutionmodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idcategorie');
    $('#idcategorie').val(id_object);
    $('#DeleteSolutionCategorie').modal({backdrop: 'static'});
});
