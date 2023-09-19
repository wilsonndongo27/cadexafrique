/********************* enregistrer un menu *******************/
$(document).on('click','#AddMenu', function (e) {
    e.preventDefault();
    $('#AddMenuModal').modal({backdrop: 'static'});
});

//call modal to crete a new menu
$(document).on('click','#updateMenu', function (e) {
    e.preventDefault();
    var menu_id = $(this).data('menuid');
    var name = $(this).data('name'); 
    var position = $(this).data('position')
    var positionname = ''
    if(position === 1){
        positionname = 'Première position'
    }else if(position === 2){
        positionname = 'Deuxième position'
    }else if(position === 3){
        positionname = 'Troisième position'
    }else if(position === 4){
        positionname = 'Quatrième position'
    }else if(position === 5){
        positionname = 'Cinquième position'
    }else{
        positionname = 'Sixième position'
    }
    var position = `<option value="`+position+`" selected>`+positionname+`</option>`;
    $('#positionupdate').append(position); 
    $('#menu_id_current').val(menu_id);
    $('#namemenuentry').val(name);
    $('#UpdateMenuModal').modal({backdrop: 'static'});
});


/** Activate  and deactivate admin  */
$(document).on('click', '#changestatusmenu', function (e) {
    var url = $(this).data('url');
    var idmenu = $(this).data('idmenu');
    var token = $(this).data('csrf');
    console.log(url, idmenu, token)
    $.ajax({
        type: 'post',
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: 'idmenu='+idmenu,
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
$(document).on('click','#deletemenumodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idmenu');
    $('#idmenu').val(id_object);
    $('#DeleteMenu').modal({backdrop: 'static'});
});

/**
* END BLOCK
*/

/**GESTION DES SOUS MENUS */
/********************* enregistrer un sous menu *******************/
$(document).on('click','#AddSubMenu', function (e) {
    e.preventDefault();
    $('#AddSubMenuModal').modal({backdrop: 'static'});
});

//call modal to update a sub menu
$(document).on('click','#updateSubMenu', function (e) {
    e.preventDefault();
    var menu_id = $(this).data('submenuid');
    var name = $(this).data('name');
    var position = $(this).data('position')
    var positionname = ''
    if(position === 1){
        positionname = 'Première position'
    }else if(position === 2){
        positionname = 'Deuxième position'
    }else if(position === 3){
        positionname = 'Troisième position'
    }else if(position === 4){
        positionname = 'Quatrième position'
    }else if(position === 5){
        positionname = 'Cinquième position'
    }else{
        positionname = 'Sixième position'
    }
    var position = `<option value="`+position+`" selected>`+positionname+`</option>`;
    $('#positionupdate').append(position); 
    $('#sub_menu_id_current').val(menu_id); 
    $('#namesubmenuentry').val(name);
    $('#UpdateSubMenuModal').modal({backdrop: 'static'});
});

/** Activate  and deactivate sous menu  */
$(document).on('click', '#changestatussubmenu', function (e) {
    var url = $(this).data('url');
    var idmenu = $(this).data('idsubmenu');
    var token = $(this).data('csrf');
    console.log(url, idmenu, token)
    $.ajax({
        type: 'post',
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: 'idmenu='+idmenu,
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

//call modal to delete a sous menu
$(document).on('click','#deletesubmenumodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idsubmenu');
    $('#idsubmenu').val(id_object);
    $('#DeleteSubMenu').modal({backdrop: 'static'});
});

/**
* END BLOCK
*/



/**GESTION DES SOUS MENUS */
$(document).on('click','#AddRubriqueSubMenu', function (e) {
    e.preventDefault();
    var menu_id = $(this).data('idsubmenu');
    var name = $(this).data('name');
    $('#sub_menu_affected').val(menu_id);
    $('#subnamemenuaffected').text(name);
    $('#AddRubriqueSubMenuModal').modal({backdrop: 'static'});
});


/**GESTION DES SOUS SOUS MENUS */
$(document).on('click','#UpdateRubriqueSubSubMenu', function (e) {
    e.preventDefault();
    var menu_id = $(this).data('idsubmenu');
    var name = $(this).data('name');
    $('#updatesub_sub_menu_affected').val(menu_id);
    $('#updatenamemenuaffected').text(name);
    $('#UpdateRubriqueMenuModal').modal({backdrop: 'static'});
});


/********************* enregistrer un sous sous menu *******************/
$(document).on('click','#AddSubSubMenu', function (e) {
    e.preventDefault();
    $('#AddSubSubMenuModal').modal({backdrop: 'static'});
});

//call modal to update a sub sub menu
$(document).on('click','#updateSubSubMenu', function (e) {
    e.preventDefault();
    var menu_id = $(this).data('subsubmenuid');
    var name = $(this).data('name');
    var position = $(this).data('position')
    var positionname = ''
    if(position === 1){
        positionname = 'Première position'
    }else if(position === 2){
        positionname = 'Deuxième position'
    }else if(position === 3){
        positionname = 'Troisième position'
    }else if(position === 4){
        positionname = 'Quatrième position'
    }else if(position === 5){
        positionname = 'Cinquième position'
    }else{
        positionname = 'Sixième position'
    }
    var position = `<option value="`+position+`" selected>`+positionname+`</option>`;
    $('#sub_sub_menu_id_current').val(menu_id);
    $('#namesubsubmenuentry').val(name);
    $('#UpdateSubSubMenuModal').modal({backdrop: 'static'});
});

/** Activate  and deactivate sous sous menu  */
$(document).on('click', '#changestatussubsubmenu', function (e) {
    var url = $(this).data('url');
    var idmenu = $(this).data('idsubsubmenu');
    var token = $(this).data('csrf');
    console.log(url, idmenu, token)
    $.ajax({
        type: 'post',
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        data: 'idmenu='+idmenu,
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

//call modal to delete a sous sous menu
$(document).on('click','#deletesubsubmenumodal', function (e) {
    e.preventDefault();
    var id_object = $(this).data('idsubsubmenu');
    $('#idsubsubmenu').val(id_object);
    $('#DeleteSubSubMenu').modal({backdrop: 'static'});
});

/**
* END BLOCK
*/

/**MANAGE OTHER DETAIL FOR SUB SUB  MENU */
$(document).on('click','#AddDetailSubSubMenu', function (e) {
    e.preventDefault();
    var idsubmenu = $(this).data("idsubmenu");
    $("#menu_id_info").val(idsubmenu);
    $('#DetailSubSubMenuModal').modal({backdrop: 'static'});
});

$(document).on('submit', '#createformcontenu', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttomcreatecontenu').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttomcreatecontenu').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
            $("#errorformcreatecontenu").css("display","none");
        },
        success: function (json) {
            if (json.etat == 1){
                $("#errorformcreatecontenu").html(json.message);
                $("#errorformcreatecontenu").css("color","white");
                $("#errorformcreatecontenu").css("background-color","#9ebfe9");
                window.location.reload();
            }else if(json.etat == 2){
                $("#errorformcreatecontenu").html(json.message);
                $("#errorformcreatecontenu").css("color","#81132b");
                $("#errorformcreatecontenu").css("background-color","#fed3dc");
            }
        },
        complete: function () {
            $('#buttomcreatecontenu').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
            $("#errorformcreatecontenu").css("display","block");
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});

//call modal visualiser contenu sub sub menu
$(document).on('click','#ViewContentSubSubMenu', function (e) {
    e.preventDefault();
    var title = $(this).data('title');
    var libelle = $(this).data('libelle');
    var description = $(this).data('description');
    var image = $(this).data('image');
    $('#titlecontenuview').text(title);
    $('#libellecontenuview').text(libelle);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#descriptioncontenuview').html(description);

    $('#imagetoupdateview').attr('src', image);
    $('#ViewContenuMenuModal').modal({backdrop: 'static'});
});


//call modal update contenu sub sub menu
$(document).on('click','#UpdateContentSubSubMenu', function (e) {
    e.preventDefault();
    var contenu_id = $(this).data('contenuid');
    var title = $(this).data('title');
    var libelle = $(this).data('libelle');
    var description = $(this).data('description');
    var image = $(this).data('image');
    $('#contenusubsub_id').val(contenu_id);
    $('#titlecontenu').val(title);
    $('#libellecontenu').val(libelle);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#post-content1upate').val(description);
    
    $('#imagetoupdate').attr('src', image);
    $('#phototoupdatecontenu').attr('src', image);
    $('#UpdateSubSubContenuModal').modal({backdrop: 'static'});
});

$(document).on('submit', '#updateformcontenu', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttonupdatecontenu').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttonupdatecontenu').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
            $("#errorupdatecontenu").css("display","none");
        },
        success: function (json) {
            if (json.etat == 1){
                $("#errorupdatecontenu").html(json.message);
                $("#errorupdatecontenu").css("color","white");
                $("#errorupdatecontenu").css("background-color","#9ebfe9");
                window.location.reload();
            }else if(json.etat == 2){
                $("#errorupdatecontenu").html(json.message);
                $("#errorupdatecontenu").css("color","#81132b");
                $("#errorupdatecontenu").css("background-color","#fed3dc");
            }
        },
        complete: function () {
            $('#buttonupdatecontenu').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
            $("#errorupdatecontenu").css("display","block");
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});



/**MANAGE OTHER DETAIL FOR SUB  MENU */
$(document).on('click','#AddDetailSubMenu', function (e) {
    e.preventDefault();
    var idsubmenu = $(this).data("idsubmenu");
    $("#menu_id_info").val(idsubmenu);
    $('#DetailSubMenuModal').modal({backdrop: 'static'});
});

$(document).on('submit', '#createformsubcontenu', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttomcreatesubcontenu').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttomcreatesubcontenu').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
            $("#errorformcreatesubcontenu").css("display","none");
        },
        success: function (json) {
            if (json.etat == 1){
                $("#errorformcreatesubcontenu").html(json.message);
                $("#errorformcreatesubcontenu").css("color","white");
                $("#errorformcreatesubcontenu").css("background-color","#9ebfe9");
                window.location.reload();
            }else if(json.etat == 2){
                $("#errorformcreatesubcontenu").html(json.message);
                $("#errorformcreatesubcontenu").css("color","#81132b");
                $("#errorformcreatesubcontenu").css("background-color","#fed3dc");
            }
        },
        complete: function () {
            $('#buttomcreatesubcontenu').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
            $("#errorformcreatesubcontenu").css("display","block");
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});

//call modal visualiser contenu sub sub menu
$(document).on('click','#ViewContentSubMenu', function (e) {
    e.preventDefault();
    var title = $(this).data('title');
    var libelle = $(this).data('libelle');
    var description = $(this).data('description');
    var image = $(this).data('image');
    $('#titlecontenuview').text(title);
    $('#libellecontenuview').text(libelle);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#descriptioncontenuview').html(description);

    $('#imagetoupdateview').attr('src', image);
    $('#ViewContenuSubMenuModal').modal({backdrop: 'static'});
});


//call modal update contenu sub sub menu
$(document).on('click','#UpdateContentSubMenu', function (e) {
    e.preventDefault();
    var contenu_id = $(this).data('contenuid');
    var title = $(this).data('title');
    var libelle = $(this).data('libelle');
    var description = $(this).data('description');
    var image = $(this).data('image');
    $('#contenu_id').val(contenu_id);
    $('#titlecontenu').val(title);
    $('#libellecontenu').val(libelle);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('#post-content1upate').val(description);
    
    $('#imagetoupdate').attr('src', image);
    $('#phototoupdatecontenu').attr('src', image);
    $('#UpdateSubContenuModal').modal({backdrop: 'static'});
});

$(document).on('submit', '#updateformsubcontenu', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttonupdatesubcontenu').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttonupdatesubcontenu').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
            $("#errorupdatesubcontenu").css("display","none");
        },
        success: function (json) {
            if (json.etat == 1){
                $("#errorupdatesubcontenu").html(json.message);
                $("#errorupdatesubcontenu").css("color","white");
                $("#errorupdatesubcontenu").css("background-color","#9ebfe9");
                window.location.reload();
            }else if(json.etat == 2){
                $("#errorupdatesubcontenu").html(json.message);
                $("#errorupdatesubcontenu").css("color","#81132b");
                $("#errorupdatesubcontenu").css("background-color","#fed3dc");
            }
        },
        complete: function () {
            $('#buttonupdatesubcontenu').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
            $("#errorupdatesubcontenu").css("display","block");
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});
