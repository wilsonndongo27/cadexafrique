<?php

use App\Events\NewChatMessage;
use Illuminate\Support\Facades\Route;

//imports controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompteAdminController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Statistique\ChartController;
use App\Http\Controllers\Statistique\TableController;
use App\Http\Controllers\GestionClients\AccountController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\InfosServicesController;
use App\Http\Controllers\InfosSolutionsController;
use App\Http\Controllers\InfosBanniereController;
use App\Http\Controllers\CategorieArticleController;
use App\Http\Controllers\CategorieSolutionsController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffProfilController;
use App\Http\Controllers\OrderDetailModelController;

/**CLIENT CONTROLLER */
use App\Http\Controllers\HomeController;
use App\Http\Controllers\userDetailController;
use App\Http\Controllers\userListController;
use App\Http\Controllers\CompteUserController;
use App\Http\Controllers\userMenuContentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**ROUTE USER */
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/About-Us', [HomeController::class, 'About'])->name('apropos');
Route::get('/detail-service/{id}/', [userDetailController::class, 'ServiceDetail'])->name('detail-service');
Route::get('/detail-article/{id}/', [userDetailController::class, 'ArticleDetail'])->name('detail-article');
Route::get('/detail-product/{id}/', [userDetailController::class, 'ProductDetail'])->name('detail-product');
Route::get('/detail-banniere/{id}/', [userDetailController::class, 'BanniereDetail'])->name('detail-banniere');
Route::get('/profil-staff/{id}/', [userDetailController::class, 'staffDetail'])->name('profil-staff');

Route::get('/list-articles/{id}/', [userListController::class, 'ListArticle'])->name('list-articles');
Route::get('/articles-list-categorie/{id}/', [userListController::class, 'ListArticleCategorie'])->name('article-categorie-list');
Route::get('/product-list/{id}/', [userListController::class, 'ListProduct'])->name('product-list');
Route::get('/service-list/{id}/', [userListController::class, 'ListService'])->name('service-list');
Route::get('/list-staff', [userListController::class, 'ListStaff'])->name('list-staff');

Route::get('/gethomepage-ajax', [HomeController::class, 'homeAjax']);

Route::get('/menu-sub-sub-content/{id}', [userMenuContentController::class, 'indexSubSubMenuContent'])->name('menu-sub-sub-content');
Route::get('/menu-sub-content/{id}', [userMenuContentController::class, 'indexSubMenuContent'])->name('menu-sub-content');

//Authentification clients
Route::post('/user_login_auth', [CompteUserController::class, 'authenticate'])->name('login_post_user');
Route::post('/logout-user', [CompteUserController::class, 'logout'])->name('logout-user');
Route::post('/signup-user', [CompteUserController::class, 'SignUpUser'])->name('signup-user');
Route::post('/news-letter-user', [SupportController::class, 'NewsLetterUser'])->name('news-letter-user');




// route login dashboard
Route::get('/admin-cadex', [AdminController::class, 'formLogin'])->name('admin_login');
Route::post('/admin_login_auth', [AdminController::class, 'authenticate'])->name('login_post_admin');
Route::get('/logout-admin', [AdminController::class, 'logout'])->name('logout');
Route::get('/dashboard-cadex', [DashboardController::class, 'dashboard'])->name('dashboard');

/**Gestion de la banniere du site */
Route::get('/dashboard-baniere', [CustomController::class, 'homeCustom'])->name('homeCustom');
Route::post('/create-slide', [CustomController::class, 'createSlide'])->name('create-slide');
Route::post('/update-slide', [CustomController::class, 'UpdateSlide'])->name('update-slide');
Route::post('/delete-slide', [CustomController::class, 'deleteSlide'])->name('delete-slide');

/** Gestion des details des de la banniere */
Route::get('/dashboard-detailbanniere/{id}', [InfosBanniereController::class, 'index'])->name('homeDetailBanniere');
Route::post('/create-detailbanniere', [InfosBanniereController::class, 'create'])->name('create-detail-banniere');
Route::post('/update-detailbanniere', [InfosBanniereController::class, 'update'])->name('update-detail-banniere');
Route::post('/delete-detailbanniere', [InfosBanniereController::class, 'destroy'])->name('delete-detail-banniere');

/**Gestion des categories des articles */
Route::get('/dashboard-categorie', [CategorieArticleController::class, 'index'])->name('homeCategorie');
Route::post('/create-categorie', [CategorieArticleController::class, 'createCategorie'])->name('create-categorie');
Route::post('/update-categorie', [CategorieArticleController::class, 'UpdateCategorie'])->name('update-categorie');
Route::post('/delete-categorie', [CategorieArticleController::class, 'deleteCategorie'])->name('delete-categorie');

/**Gestion des categories des solutions */
Route::get('/dashboard-categorie-solution', [CategorieSolutionsController::class, 'index'])->name('homeCategorieSolution');
Route::post('/create-categorie-solution', [CategorieSolutionsController::class, 'createCategorie'])->name('create-categorie-solution');
Route::post('/update-categorie-solution', [CategorieSolutionsController::class, 'UpdateCategorie'])->name('update-categorie-solution');
Route::post('/delete-categorie-solution', [CategorieSolutionsController::class, 'deleteCategorie'])->name('delete-categorie-solution');

/**Gestion des services */
Route::get('/dashboard-service', [ServiceController::class, 'homeService'])->name('homeService');
Route::post('/create-service', [ServiceController::class, 'CreateService'])->name('create-service');
Route::post('/update-service', [ServiceController::class, 'UpdateService'])->name('update-service');
Route::post('/delete-service', [ServiceController::class, 'deleteService'])->name('delete-service');

/** Gestion des details des services  */
Route::get('/dashboard-detailarticle/{id}', [InfosServicesController::class, 'index'])->name('homeDetailArticle');
Route::post('/create-detailarticle', [InfosServicesController::class, 'create'])->name('create-detail-article');
Route::post('/update-detailarticle', [InfosServicesController::class, 'update'])->name('update-detail-article');
Route::post('/delete-detailarticle', [InfosServicesController::class, 'destroy'])->name('delete-detail-article');


/** Gestion des articles  */
Route::get('/dashboard-article', [ArticleController::class, 'homeArticle'])->name('homeArticle');
Route::post('/create-article', [ArticleController::class, 'CreateArticle'])->name('create-article');
Route::post('/update-article', [ArticleController::class, 'UpdateArticle'])->name('update-article');
Route::post('/delete-article', [ArticleController::class, 'deleteArticle'])->name('delete-article');
Route::post('/status-article', [ArticleController::class, 'UpdateStatusArticle'])->name('status-article');

/** Gestion des categories des solutions  */
Route::get('/dashboard-solution', [SolutionController::class, 'index'])->name('homeSolution');
Route::post('/create-solution', [SolutionController::class, 'store'])->name('create-solution');
Route::post('/update-solution', [SolutionController::class, 'update'])->name('update-solution');
Route::post('/delete-solution', [SolutionController::class, 'destroy'])->name('delete-solution');
//Route::post('/status-article', [ArticleController::class, 'UpdateStatusArticle'])->name('status-article');

/** Gestion des details des solutions  */
Route::get('/dashboard-detailsolution/{id}', [InfosSolutionsController::class, 'index'])->name('homeDetailSolution');
Route::post('/create-detailsolution', [InfosSolutionsController::class, 'create'])->name('create-detail-solution');
Route::post('/update-detailsolution', [InfosSolutionsController::class, 'update'])->name('update-detail-solution');
Route::post('/delete-detailsolution', [InfosSolutionsController::class, 'destroy'])->name('delete-detail-solution');

/**Gestion des administrateurs */
Route::get('/dashboard-admins', [CompteAdminController::class, 'HomeAdmins'])->name('homeAdmin');
Route::post('/create-admin', [CompteAdminController::class, 'CreateAdmin'])->name('create-admin');
Route::post('/update-admin', [CompteAdminController::class, 'UpdateAdmin'])->name('update-admin');
Route::post('/delete-admin', [CompteAdminController::class, 'deleteAdmin'])->name('delete-admin');
Route::post('/status-admin', [CompteAdminController::class, 'UpdateStatusAdmin'])->name('status-admin');

/**Getsion du module supports */
Route::get('/dashboard-support', [SupportController::class, 'indexSupport'])->name('homeSupport');
Route::post('/send-mail', [SupportController::class, 'createMail'])->name('send-mail');
Route::post('/delete-ticket', [SupportController::class, 'destroyTicket'])->name('delete-ticket');

/**Gestion des Graphes */
Route::get('/dashboard-chart', [ChartController::class, 'indexChart'])->name('homeChart');
Route::get('/dashboard-table', [TableController::class, 'indexTable'])->name('homeTable');

/**Gestion des comptes des clients */
Route::get('/dashboard-client-account', [AccountController::class, 'indexAccount'])->name('homeAccountClient');

/** gestion du chat boot */
Route::get('/dashboard-chatboot', [MessageController::class, 'indexChatboot'])->name('homeChatboot');
//Route::get('/chatboot-message', [MessageController::class, 'fetchMessages'])->name('getmessage');
//Route::get('/chatboot-send-message', [MessageController::class, 'sendMessage'])->name('sendmessage');
Route::get('/chatboot-message', [MessageController::class, 'fetchMessages'])->name('getmessage');

/**Gestion des menus */
Route::get('/dashboard-menus', [MenusController::class, 'Menuindex'])->name('homeMenu');
Route::post('/create-menu', [MenusController::class, 'createMenu'])->name('create-menu');
Route::post('/change-menu-status', [MenusController::class, 'changeStatusMenu'])->name('change-menu-status');
Route::post('/update-menu', [MenusController::class, 'UpdateMenu'])->name('update-menu');
Route::post('/delete-menu', [MenusController::class, 'deleteMenu'])->name('delete-menu');

/**Gestion des sous menus */
Route::get('/dashboard-sub-menus/{id}', [MenusController::class, 'SubMenuindex'])->name('homeSubMenu');
Route::post('/create-sub-menu', [MenusController::class, 'createSubMenu'])->name('create-sub-menu');
Route::post('/change-sub-menu-status', [MenusController::class, 'changeStatusSubMenu'])->name('change-sub-menu-status');
Route::post('/update-sub-menu', [MenusController::class, 'UpdateSubMenu'])->name('update-sub-menu');
Route::post('/delete-sub-menu', [MenusController::class, 'deleteSubMenu'])->name('delete-sub-menu');

/**Gestion des sous sous menus */
Route::get('/dashboard-sub-sub-menus/{id}', [MenusController::class, 'SubSubMenuindex'])->name('homeSubSubMenu');
Route::post('/create-sub-sub-menu', [MenusController::class, 'createSubSubMenu'])->name('create-sub-sub-menu');
Route::post('/change-sub-sub-menu-status', [MenusController::class, 'changeStatusSubSubMenu'])->name('change-sub-sub-menu-status');
Route::post('/update-sub-sub-menu', [MenusController::class, 'UpdateSubSubMenu'])->name('update-sub-sub-menu');
Route::post('/delete-sub-sub-menu', [MenusController::class, 'deleteSubSubMenu'])->name('delete-sub-sub-menu');


/**Gestion du staff */
Route::get('/dashboard-staff', [StaffController::class, 'StaffIndex'])->name('homeStaff');
Route::post('/create-staff', [StaffController::class, 'createStaff'])->name('create-staff');
Route::post('/change-staff-status', [StaffController::class, 'changeStaff'])->name('change-staff-status');
Route::post('/update-staff', [StaffController::class, 'UpdateStaff'])->name('update-staff');
Route::post('/delete-staff', [StaffController::class, 'deleteStaff'])->name('delete-staff');


/**Gestion des informations de l'entreprise */
Route::get('/dashboard-entreprise', [StaffController::class, 'EntrepriseIndex'])->name('homeEntreprise');
Route::post('/create-entreprise', [StaffController::class, 'createEntreprise'])->name('create-entreprise');
Route::post('/update-entreprise', [StaffController::class, 'UpdateEntreprise'])->name('update-entreprise');

/**Gestion des contenus des sous sous menus */
Route::post('/create-other', [OrderDetailModelController::class, 'createOther'])->name('create-other');
Route::post('/update-other', [OrderDetailModelController::class, 'UpdateOther'])->name('update-other');
Route::post('/delete-other', [OrderDetailModelController::class, 'deleteOther'])->name('delete-other');

//**Gestion des contenus des sous menus */
Route::post('/create-contenu-sub', [OrderDetailModelController::class, 'createSubContenu'])->name('create-contenu-sub');
Route::post('/update-contenu-sub', [OrderDetailModelController::class, 'UpdateSubContenu'])->name('update-contenu-sub');
Route::post('/delete-contenu-sub', [OrderDetailModelController::class, 'deleteSubContenu'])->name('delete-contenu-sub');


//**Gestion des affectations des rubriques au menus */
Route::post('/affect-rubrique-sub-sub', [MenusController::class, 'affectedRubriqueSubSubMenu'])->name('affect-rubrique-sub-sub');
Route::post('/affect-rubrique-sub', [MenusController::class, 'affectedRubriqueSubMenu'])->name('affect-rubrique-sub');

/**Gestion du Profil */
Route::get('/dashboard-profil-staff', [StaffProfilController::class, 'StaffProfilIndex'])->name('homeProfil');
Route::post('/create-profil-staff', [StaffProfilController::class, 'createProfilStaff'])->name('create-profil-staff');
Route::post('/change-profil-status', [StaffProfilController::class, 'changeProfilStaffStatus'])->name('change-profil-status');
Route::post('/update-profil-staff', [StaffProfilController::class, 'UpdateProfilStaff'])->name('update-profil-staff');
Route::post('/delete-profil-staff', [StaffProfilController::class, 'deleteProfilStaff'])->name('delete-profil-staff');
