/********************* enregistrer un administrateur *******************/ 
$(document).on('click','#AddAdmin', function (e) {
    e.preventDefault();
    $('#AddAdminModal').modal({backdrop: 'static'});
});

/**mise a jour des informations de l'administrateur */
$(document).on('click','#updateadmin', function (e) {
    e.preventDefault();
    var admin_id = $(this).data('adminid');
    var name = $(this).data('name');
    var email = $(this).data('email');
    var telephone = $(this).data('telephone');
    var photo = $(this).data('photo');
    $('#admin_id').val(admin_id);
    $('#nameadmin').val(name);
    $('#adminemail').val(email);
    $('#admintelephone').val(telephone);
    $('#phototoupdateadmin').attr('src', photo);
    $('#UpdateAdminModal').modal({backdrop: 'static'});
});

/**mise a jour des informations de l'administrateur */
$(document).on('click','#detailmodal', function (e) {
    e.preventDefault();
    var name = $(this).data('name');
    var email = $(this).data('email');
    var telephone = $(this).data('telephone');
    var photo = $(this).data('photo');
    var status = $(this).data('status');
    if(status == 0){
        $('.fa-globe-africa').removeClass('statusactif').addClass('statusinactif');
    }
    $('.name-admin').text(name);
    $('#admin-email').text(email);
    $('#admin-telephone').text(telephone);
    $('#photo-admin').attr('src', photo);
    $('#DetailAdmin').modal({backdrop: 'static'});
});

/**supprimer un administrateur */
$(document).on('click','#deleteadminmodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idadmin');
    $('#idadmin').val(id_object);
    $('#DeleteAdmin').modal({backdrop: 'static'});
});

/** Activate  and deactivate admin  */
$(document).on('click','#changestatus', function (e) {
    e.preventDefault();
    var statusvalue = $(this).data('statusvalue');
    var currentadmin = $(this).data('currentadmin');
    var nameadmin = $(this).data('nameadmin');
    $('#statusvalueid').val(statusvalue);
    $('#currentadminid').val(currentadmin);
    $('#currentnameadmin').text(nameadmin);
    if(statusvalue == '1'){
        $('#textstatusconfirm').html('Voulez-vous vraiment bloquer cet administrateur ?')
    }else{
        $('#textstatusconfirm').html('Voulez-vous vraiment débloquer cet administrateur ?')
    }
    $('#AdminStatus').modal({backdrop: 'static'});
});
$(document).on('submit', '#changestatusform', function (e) {
    var currentadmin = document.getElementById('currentadminid').value;
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttonstatus').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttonstatus').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
            $("#errorformchangerstatus").css("display","none");
        },
        success: function (json) {
            if (json.etat == 1){
                window.location.reload();
            }
        },
        complete: function () {
            $('#buttonstatus').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
            $("#errorformchangerstatus").css("display","block");
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});







/**
* END BLOCK
*/