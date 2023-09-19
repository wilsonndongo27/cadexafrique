/*!
    * Start Bootstrap - SB Admin v6.0.1 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function(){
        if (this.href === path) {
            $(this).addClass("");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

/**********************************************Script de connexion des administrateurs au dashboard ******************** */
$(document).on('submit', '#loginadminform', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttonlogin').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttonlogin').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
            $("#errorlogin").css("display","none");
        },
        success: function (json) {
            if (json.etat == 1){
                $("#errorlogin").html(json.message);
                $("#errorlogin").css("color","white");
                $("#errorlogin").css("background-color","#9ebfe9");
                window.location.assign('/dashboard-cadex');
            }else if(json.etat == 2){
                $("#errorlogin").html(json.message);
                $("#errorlogin").css("color","#81132b");
                $("#errorlogin").css("background-color","#fed3dc");
            }
        },
        complete: function () {
            $('#buttonlogin').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
            $("#errorlogin").css("display","block");
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});


/*************************************SHOW PASSWORD WHEN LOGIN ***************************** */
$("#show_hide_password a").on('click', function(event) {
    event.preventDefault();
    if($('#show_hide_password input').attr("type") == "text"){
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass( "fa-eye-slash" );
        $('#show_hide_password i').removeClass( "fa-eye" );
    }else if($('#show_hide_password input').attr("type") == "password"){
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass( "fa-eye-slash" );
        $('#show_hide_password i').addClass( "fa-eye" );
    }
});



$(document).on('submit', '#createform', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttomcreate').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttomcreate').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
            $("#errorformcreate").css("display","none");
        },
        success: function (json) {
            if (json.etat == 1){
                $("#errorformcreate").html(json.message);
                $("#errorformcreate").css("color","white");
                $("#errorformcreate").css("background-color","#9ebfe9");
                window.location.reload();
            }else if(json.etat == 2){
                $("#errorformcreate").html(json.message);
                $("#errorformcreate").css("color","#81132b");
                $("#errorformcreate").css("background-color","#fed3dc");
            }
        },
        complete: function () {
            $('#buttomcreate').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
            $("#errorformcreate").css("display","block");
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});

$(document).on('submit', '#updateform', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttonupdate').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttonupdate').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
            $("#errorupdate").css("display","none");
        },
        success: function (json) {
            if (json.etat == 1){
                $("#errorupdate").html(json.message);
                $("#errorupdate").css("color","white");
                $("#errorupdate").css("background-color","#9ebfe9");
                window.location.reload();
            }else if(json.etat == 2){
                $("#errorupdate").html(json.message);
                $("#errorupdate").css("color","#81132b");
                $("#errorupdate").css("background-color","#fed3dc");
            }
        },
        complete: function () {
            $('#buttonupdate').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
            $("#errorupdate").css("display","block");
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});


$(document).on('submit', '#delete_form', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttondelete').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttondelete').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
            $("#errorformdelete").css("display","none");
        },
        success: function (json) {
            if (json.etat == 1){
                $("#errorformdelete").html(json.message);
                $("#errorformdelete").css("color","white");
                $("#errorformdelete").css("background-color","#9ebfe9");
                window.location.reload();
            }else if(json.etat == 2){
                $("#errorformdelete").html(json.message);
                $("#errorformdelete").css("color","#81132b");
                $("#errorformdelete").css("background-color","#fed3dc");
            }
        },
        complete: function () {
            $('#buttondelete').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
            $("#errorformdelete").css("display","block");
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});

/** gestion des tables list */
$(document).ready(function() {
    $('.dataTables_filter').addClass('hidesearchbar');
    $('#articles-table').DataTable({
        language : {
            url : 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
        }
    });

});


/**
* END BLOCK
*/

/**EDITOR QUILL */
var quill;

$(document).ready(function(){
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
      
        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
      
        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
    
        ['clean'],                                         // remove formatting button
        ['image'],
        ['link']
    ];
    
    quill = new Quill('.editor', {
    theme: 'snow',
    modules: { 
            toolbar: {
                container: toolbarOptions,
            }
        },
        imageHandler: imageHandler
    });

    quill = new Quill('.editorupdate', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: toolbarOptions,
            }
        },
        imageHandler: imageHandler
    });

    function imageHandler(image, callback) {
        var data = new FormData();
        data.append('image', image);
    
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 200 && response.success) {
                callback(response.data.link);
            } else {
                var reader = new FileReader();
                reader.onload = function(e) {
                callback(e.target.result);
                };
                reader.readAsDataURL(image);
            }
            }
        }
        xhr.send(data);
    }
    
 
})

var postSubmission = function(){
    editor = document.querySelector(".editor");
    contentInput = document.querySelector(".post-content");
    contentInput.value = editor.innerHTML;
}

var postSubmissionUpdate = function(){
    editor = document.querySelector(".editorupdate");
    contentInput = document.querySelector(".post-content-update");
    contentInput.value = editor.innerHTML;
}

