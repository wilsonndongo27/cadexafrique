/********************* enregistrer un staff *******************/
$(document).on('click','#AddStaff', function (e) {
    e.preventDefault();
    $('#AddStaffModal').modal({backdrop: 'static'});
});

//call modal to crete a new menu
$(document).on('click','#updateStaff', function (e) {
    e.preventDefault();
    var staff_id = $(this).data('staffid');
    var first_name = $(this).data('first_name');
    var last_name = $(this).data('last_name');
    var telephone = $(this).data('telephone');
    var adresse = $(this).data('adresse');
    var email = $(this).data('email');
    var freetext1 = $(this).data('freetext1');
    var photo = $(this).data('photo'); 
    var poste = `<option value="`+$(this).data('posteid')+`" selected>`+$(this).data('poste')+`</option>`;
    $('#posteid').append(poste); 
    $('#staff_id').val(staff_id);
    $('#firstnameid').val(first_name);
    $('#lastnameid').val(last_name);
    $('#telephoneid').val(telephone);
    $('#adresseid').val(adresse);
    $('#emailid').val(email);
    $('#freetextid').val(freetext1);
    
    const delta = quill.clipboard.convert(freetext1)
    quill.setContents(delta, 'silent')
    $('#post-content1upate').val(freetext1);

    $('#phototoupdate').attr("src", "/storage/"+photo);
    $('#namestaff').text(first_name);
    $('#UpdateStaffModal').modal({backdrop: 'static'});
});


/** Activate  and deactivate staff  */
$(document).on('click', '#changestatusstaff', function (e) {
    var url = $(this).data('url');
    var idstaff = $(this).data('staffid');
    var token = $(this).data('csrf');
    $.ajax({
        type: 'post',
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: 'idstaff='+idstaff,
        datatype: 'json',
        beforeSend: function () {
            $(document.body).css({'cursor' : 'wait'});
        },
        success: function (json) {
            $('.blockbutton').empty();
            if (json.etat == 1){
                console.log('tous cest bien passer');
                toastr.success(json.message);
                if(json.newwtatus == 1){
                    $("#textstatus").text("Deactiver");
                }else{
                    $("#textstatus").text("Activer");
                }
                window.location.reload();
            }else{
                toastr.success(json.message)
            }
        },
        complete: function () {
            $(document.body).css({'cursor' : 'default'});
        },
    });
});



//call modal to delete a menu
$(document).on('click','#deletestaffmodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('staffid');
    $('#idstaff').val(id_object);
    $('#DeleteStaff').modal({backdrop: 'static'});
});



/**
* END BLOCK
*/


/**PROFIL DES STAFF */
/********************* enregistrer un staff *******************/
$(document).on('click','#AddProfil', function (e) {
    e.preventDefault();
    $('#AddprofilModal').modal({backdrop: 'static'});
});

//call modal to crete a new profil
$(document).on('click','#updateProfil', function (e) {
    e.preventDefault();
    var profil_id = $(this).data('profilid');
    var name = $(this).data('name');
    $('#profil_id').val(profil_id);
    $('#profilnameid').val(name);
    $('#UpdateProfilModal').modal({backdrop: 'static'});
});


/** Activate  and deactivate staff  */
$(document).on('click', '#changestatusprofil', function (e) {
    var url = $(this).data('url');
    var idprofil = $(this).data('profilid');
    var token = $(this).data('csrf');
    $.ajax({
        type: 'post',
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: 'idprofil='+idprofil,
        datatype: 'json',
        beforeSend: function () {
            $(document.body).css({'cursor' : 'wait'});
        },
        success: function (json) {
            $('.blockbutton').empty();
            if (json.etat == 1){
                console.log('tous cest bien passer');
                toastr.success(json.message);
                if(json.newwtatus == 1){
                    $("#textstatus").text("Deactiver");
                }else{
                    $("#textstatus").text("Activer");
                }
                window.location.reload();
            }else{
                toastr.success(json.message)
            }
        },
        complete: function () {
            $(document.body).css({'cursor' : 'default'});
        },
    });
});



//call modal to delete a menu
$(document).on('click','#deleteprofilmodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('profilid');
    $('#idprofil').val(id_object);
    $('#DeleteProfil').modal({backdrop: 'static'});
});

/**END PROFIL */


/**GESTION INFOS ENTRTEPRISE */
$(document).on('click','#AddInfosEntreprise', function (e) {
    e.preventDefault();
    $('#AddEntrepriseModal').modal({backdrop: 'static'});
});


//call modal to update entreprise info
$(document).on('click','#UpdateInfos', function (e) {
    e.preventDefault();
    var name = $(this).data('name');
    var email1 = $(this).data('email1');
    var email2 = $(this).data('email2');
    var adresse1 = $(this).data('adresse1');
    var adresse2 = $(this).data('adresse2');
    var telephone1 = $(this).data('telephone1');
    var telephone2 = $(this).data('telephone2');
    var activity = $(this).data('activity');
    var vision = $(this).data('vision');
    var mission = $(this).data('mission');
    var objectifs = $(this).data('objectifs');
    var contexte = $(this).data('contexte');
    var maplink = $(this).data('maplink');
    var logo = $(this).data('logo');
    var cover = $(this).data('cover');
    $('#nameid').val(name);
    $('#email1id').val(email1);
    $('#email2id').val(email2);
    $('#adresse1id').val(adresse1);
    $('#adresse2id').val(adresse2);
    $('#telephone1id').val(telephone1);
    $('#telephone2id').val(telephone2);
    $('#activityid').val(activity);
    $('#visionid').val(vision);
    $('#missionid').val(mission);
    $('#objectifsid').val(objectifs);
    $('#contexteid').val(contexte);
    $('#maplinkid').val(maplink);
    $('#nameentreprise').text(name)
    $('#logoupdateid').attr("src", "/storage/"+logo);
    $('#coverupdateid').attr("src", "/storage/"+cover);
    $('#UpdateEntInfosModal').modal({backdrop: 'static'});
});
