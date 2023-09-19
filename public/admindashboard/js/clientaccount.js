/********************* enregistrer un service *******************/ 
$(document).on('click','#AddClientAccount', function (e) {
    e.preventDefault();
    $('#AddClientAccountModal').modal({backdrop: 'static'});
});

//call modal to crete a new post
$(document).on('click','#updateclientaccount', function (e) {
    e.preventDefault();
    var account_id = $(this).data('accountid');
    var firstname = $(this).data('firstname');
    var lastname = $(this).data('lastname');
    var sexe = $(this).data('sexe');
    var email = $(this).data('email');
    var telephone = $(this).data('telephone');
    var datenaissance = $(this).data('datenaissance');
    var pays = $(this).data('pays');
    var typecompte = $(this).data('typecompte');
    var soussecteur = $(this).data('soussecteur');
    var adresse = $(this).data('adresse');
    var photoidentite = $(this).data('photoidentite');
    var signature = $(this).data('signature');
    var planlocalisation = $(this).data('planlocalisation');
    $('#account_id').val(account_id);
    $('#firstname_id').val(firstname);
    $('#lastname_id').val(lastname);
    $('#sexe_id').val(sexe);
    $('#email_id').val(email);
    $('#telephone_id').val(telephone);
    $('#datenaissance_id').val(datenaissance);
    $('#pays_id').val(pays);
    $('#typecompte_id').val(typecompte);
    $('#soussecteur_id').val(soussecteur);
    $('#adresse_id').val(adresse);
    $('#signature_id').val(signature);
    $('#photoidentite_id').attr('src',photoidentite);
    $('#planlocalisation_id').attr('src', planlocalisation);
    $('#AddClientAccountModal').modal({backdrop: 'static'});
});



//call modal to delete a post
$(document).on('click','#deletearticlemodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idarticle');
    $('#idarticle').val(id_object);
    $('#DeleteArticle').modal({backdrop: 'static'});
});


/**upload image cni recto  */
$('#uploadcnirecto').on('click', function(){
    $('#photo_cni_recto').trigger('click');

});

function PhotoRecto(value){
    if(value !== '' || value !== undefined){
        $('#titleuploadcnirecto').text('Chargement Ok!')
    }
}


/**upload image cni verso  */
$('#uploadcniverso').on('click', function(){
    $('#photo_cni_verso').trigger('click');

});

function PhotoVerso(value){
    if(value !== '' || value !== undefined){
        $('#titleuploadcniverso').text('Chargement Ok!')
    }
}

/**upload image signature  */
$('#uploadsignature').on('click', function(){
    $('#photo_signature').trigger('click');

});

function PhotoSignature(value){
    if(value !== '' || value !== undefined){
        $('#titleuploadsignature').text('Chargement Ok!')
    }
}


/**upload image plan localisation  */
$('#uploadlocalisation').on('click', function(){
    $('#photo_localisation').trigger('click');

});

function PhotoLocalisation(value){
    if(value !== '' || value !== undefined){
        $('#titleuploadlocalisation').text('Chargement Ok!')
    }
}


/**
* END BLOCK
*/
