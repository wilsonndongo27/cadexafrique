/********************* envoyez un mail *******************/ 
$(document).on('click','#sendmail', function (e) {
    e.preventDefault();
    var id = $(this).data('idticket');
    var email = $(this).data('emaildest');
    var id = $(this).data('idticket');
    $('#idticket').val(id);
    $('#emaildest').val(email);
    $('#SendMailModal').modal({backdrop: 'static'});
});


//call modal to delete a post
$(document).on('click','#deleteticketmodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idticket');
    $('#idticketform').val(id_object);
    $('#DeleteTicket').modal({backdrop: 'static'});
});


/**
* END BLOCK
*/
