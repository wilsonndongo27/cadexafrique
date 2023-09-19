/**Loader modal */
$(window).on('load',function(){
	GetHomeData();
});

const scheme = window.location.protocol;
const baseUrl = scheme + "//" + window.location.host;
const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

function GetHomeData(){
	$.ajax({
		url:baseUrl+"/gethomepage-ajax",
		type:"GET",
		headers: {"X-CSRF-TOKEN": csrfToken},
		dataType:"json",
		beforeSend: function(){
		},
		success: function(data){
            if(data.status == "200"){
			    $("#globalloader").modal("hide");
                var responseArticle = data.allarticle;
                var responseProduct = data.allproduct;
                var responseBanniere = data.allbanniere;
                var responseCategorie = data.allcategorie;
                var responseService = data.allservice;


            }

		},
		complete: function(){
			$("#globalloader").modal("hide");
		},
		error: function(){}
	})
}

function HomePage(){
    window.location.assign("/");
}

function AllActuality(item){
    var menuid = item.getAttribute("menuid");
    window.location.assign("/list-articles/"+menuid+'/');
}


function DetailArticle(item){
    var articleid = item.getAttribute("articleid");
	window.location.assign("/detail-article/"+articleid+"/");
}


function ListArticleCategorie(item){
    var categorieid = item.getAttribute("categorieid");
	window.location.assign("/articles-list-categorie/"+categorieid+"/");
}


function AllProduct(item){
    var menuid = item.getAttribute("menuid");
    window.location.assign("/product-list/"+menuid+'/');
}

function DetailProduct(item){
    var productid = item.getAttribute("productid");
    window.location.assign("/detail-product/"+productid+"/");
}

function AllService(item){
    var menuid = item.getAttribute("menuid");
    window.location.assign("/service-list/"+menuid+'/');
}

function DetailService(item){
    var serviceid = item.getAttribute("serviceid")
    window.location.assign("/detail-service/"+serviceid+"/")
}

function DetailBanniere(item){
    var banniereid = item.getAttribute("banniereid")
    window.location.assign("/detail-banniere/"+banniereid+"/")
}

function ContentSousSousMenu(item){
    var menuid = item.getAttribute("menuid")
    window.location.assign("/menu-sub-sub-content/"+menuid+"/")
}

function ContentSousMenu(item){
    var menuid = item.getAttribute("menuid")
    window.location.assign("/menu-sub-content/"+menuid+"/")
}

function staffDetail(item){
    var staffid = item.getAttribute("staffid")
    window.location.assign("/profil-staff/"+staffid+"/")
}

function AboutUs(){
    window.location.assign("/About-Us/");
}

function Allstaff(){
    window.location.assign("/list-staff/");
}

function SignIn(){
    $(".LoginModal").modal("show");
}

function CloseModalLogin(){
    $(".LoginModal").modal("hide");
}

function SignUp(){ 
    $(".signupModal").modal("show");
}

function CloseModalSignUP(){
    $(".signupModal").modal("hide");
}

/**Manage Objectif Home */
function toggleObjectifAll(){
	$(".showobjectif").css("display", "block");
	$(".hideobjectif").css("display", "none");
	$(".buttonshow").css("display", "none");
	$(".buttonhide").css("display", "block");
}

function toggleObjectifHide(){
	$(".showobjectif").css("display", "none");
	$(".hideobjectif").css("display", "block");
	$(".buttonshow").css("display", "block");
	$(".buttonhide").css("display", "none");
}

/**GESTION DE LAUTHENTIFICATION DES ABONNES */
$(document).on('submit', '#signupform', function (e) {
	e.preventDefault();
	var url = $(this).attr('action');
	var form = $(this);
	var formdata = (window.FormData) ? new FormData(form[0]) : null;
	var data = (formdata !== null) ? formdata : form.serialize();
	var valBtn = $('#signupbtn').text();
	$.ajax({
		type: 'post',
		url: url,
		data: data,
		contentType: false,
		processData: false,
		datatype: 'json',
		beforeSend: function () {
			$("#globalloader").modal("show");
			$('#signupbtn').text('en cours...').prop('disabled',true);
			$(document.body).css({'cursor' : 'wait'});
			form.find('*').prop('disabled', true);
		},
		success: function (json) {
			if (json.status == 200){
				toastr.success(json.message);
				$("#statusmessage").html(json.message);
				$(".signupModal").modal("hide");
				$(".signupModalActivateAccount").modal("show");
			}else{
				toastr.warning(json.message);
			}
		},
		complete: function () {
			$("#globalloader").modal("hide");
			$('#signupbtn').text(valBtn).prop('disabled',false);
			$(document.body).css({'cursor' : 'default'});
			form.find('*').prop('disabled', false);
		},
		error: function(jqXHR, textStatus, errorThrown){}
	});
});

$(document).on('submit', '#signupactivateform', function (e) {
	e.preventDefault();
	var url = $(this).attr('action');
	var form = $(this);
	var formdata = (window.FormData) ? new FormData(form[0]) : null;
	var data = (formdata !== null) ? formdata : form.serialize();
	var valBtn = $('#signupbtnactivate').text();
	$.ajax({
		type: 'post',
		url: url,
		data: data,
		contentType: false,
		processData: false,
		datatype: 'json',
		beforeSend: function () {
			$('#signupbtnactivate').text('en cours...').prop('disabled',true);
			$(document.body).css({'cursor' : 'wait'});
			form.find('*').prop('disabled', true);
		},
		success: function (json) {
			if (json.status == 200){
				toastr.success(json.message);
				window.location.reload();
			}else{
				toastr.warning(json.message);
			}
		},
		complete: function () {
			$('#signupbtnactivate').text(valBtn).prop('disabled',false);
			$(document.body).css({'cursor' : 'default'});
			form.find('*').prop('disabled', false);
		},
		error: function(jqXHR, textStatus, errorThrown){}
	});
});

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#InputPassword");

togglePassword.addEventListener("click", function () {
	// toggle the type attribute
	const type = password.getAttribute("type") === "password" ? "text" : "password";
	password.setAttribute("type", type);

	// toggle the icon
	this.classList.toggle("bi-eye");
});

$(document).on('submit', '#loginform', function (e) {
	e.preventDefault();
	var url = $(this).attr('action');
	var form = $(this);
	var formdata = (window.FormData) ? new FormData(form[0]) : null;
	var data = (formdata !== null) ? formdata : form.serialize();
	var valBtn = $('#loginbtn').text();
	$.ajax({
		type: 'post',
		url: url,
		data: data,
		contentType: false,
		processData: false,
		datatype: 'json',
		beforeSend: function () {
			$('#loginbtn').text('en cours...').prop('disabled',true);
			$(document.body).css({'cursor' : 'wait'});
			form.find('*').prop('disabled', true);
		},
		success: function (json) {
			if (json.status == 200){
				toastr.success(json.message);
				window.location.reload();
			}else{
				toastr.warning(json.message);
			}
		},
		complete: function () {
			$('#loginbtn').text(valBtn).prop('disabled',false);
			$(document.body).css({'cursor' : 'default'});
			form.find('*').prop('disabled', false);
		},
		error: function(jqXHR, textStatus, errorThrown){}
	});
});

function FetchCountry(){
	//Loop through returned result and populate countries select
	for(i=0; i<countryListAlpha2.length; i++){
		var code = countryListAlpha2[i].code;
		var label = countryListAlpha2[i].label;
		$('#InputPays').append($("<option value="+code+">"+label+"</option>"))
	}

}

//Function to fetch states
function initStates(){
	//Get selected country name
	var country=$("#InputPays").val();

	//Remove previous loaded states
	$('#InputVille option:gt(0)').remove();
	$('#district-select option:gt(0)').remove();


}


/**FIN DE LAUTHENTIFICATION */

/**submit forù news letter */
$(document).on('submit', '#contactform', function (e) {
	e.preventDefault();
	var url = $(this).attr('action');
	var form = $(this);
	var formdata = (window.FormData) ? new FormData(form[0]) : null;
	var data = (formdata !== null) ? formdata : form.serialize();
	var valBtn = $('#newsletterbtn').text();
	$.ajax({
		type: 'post',
		url: url,
		data: data,
		contentType: false,
		processData: false,
		datatype: 'json',
		beforeSend: function () {
			$('#newsletterbtn').text('en cours...').prop('disabled',true);
			$(document.body).css({'cursor' : 'wait'});
			form.find('*').prop('disabled', true);
		},
		success: function (json) {
			if (json.status == 200){
				toastr.success(json.message);
			}else{
				toastr.warning(json.message);
			}
		},
		complete: function () {
			$('#newsletterbtn').text(valBtn).prop('disabled',false);
			$(document.body).css({'cursor' : 'default'});
			form.find('*').prop('disabled', false);
            form[0].reset();
		},
		error: function(jqXHR, textStatus, errorThrown){} 
	});
});



$('.has-sub-sub a.subsubmenubtn').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
});



/*Manage btn whasappchat***/
function redirectWhatsapp(){
	window.open('https://wa.me/237697047110?text=Salut%20je%20vous%20écris%20depuis%20votre%20site%20web%20https://cadexafrique.com.', '_blank')
}


/**MANAGE LANGUAGE */
function googleTranslateElementInit() {
	new google.translate.TranslateElement({pageLanguage: 'fr'}, 'google_translate_element');
	
	var $googleDiv = $("#google_translate_element .skiptranslate");
	var $googleDivChild = $("#google_translate_element .skiptranslate div");
	$googleDivChild.next().remove();
	
	$googleDiv.contents().filter(function(){
		return this.nodeType === 3 && $.trim(this.nodeValue) !== '';
	}).remove();
}

$("body").on("change", ".goog-te-combo", function (e) {
	if($(".goog-te-combo").val()){
		$('#originelanguage').css('display', 'block');
	}else{
		console.log('No language is selected')
	}
});

$('#originelanguage').on('click', function(){
	window.location.reload();
})

