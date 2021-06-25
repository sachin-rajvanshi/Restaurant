<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\DealController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\KitchenController;
use App\Http\Controllers\Admin\QuantityController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\FoodItemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\User\AddressBookController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\GalleryCategoryController;

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


/*
|--------------------------------------------------------------------------
| Home Page Section Routes 
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('policy', [HomeController::class, 'policy'])->name('policy');
Route::get('terms', [HomeController::class, 'terms'])->name('terms');
Route::get('refund/content', [HomeController::class, 'refund'])->name('refund');
Route::get('shipping', [HomeController::class, 'shipping'])->name('shipping');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('career', [HomeController::class, 'career'])->name('career');
Route::post('career/enquiry', [HomeController::class, 'careerEnquiry'])->name('careerEnquiry');
Route::get('gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('gallery/images/{id}', [HomeController::class, 'galleryImages'])->name('galleryImages');
Route::get('guest/review', [HomeController::class, 'guestReview'])->name('guestReview');
Route::post('guest/review', [HomeController::class, 'createGuestReview'])->name('createGuestReview');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::post('contact/enquiry', [HomeController::class, 'contactEnquiry'])->name('contactEnquiry');
Route::get('offer', [HomeController::class, 'offer'])->name('offer');
Route::get('all/food/items', [HomeController::class, 'foods'])->name('foods');
Route::post('food/items/filters', [HomeController::class, 'foodFilters'])->name('foodFilters');
Route::get('food/detail/{id}', [HomeController::class, 'foodDetails'])->name('foodDetails');
Route::post('add/favourite', [HomeController::class, 'addFavourite'])->name('addFavourite');

// Food & Cart Route
Route::post('food/cart/model', [CartController::class, 'foodCartModel'])->name('food.foodCartModel');
Route::post('add-food/cart', [CartController::class, 'addFoodToCart'])->name('food.addFoodToCart');
Route::get('cart', [CartController::class, 'cart'])->name('food.cart');
Route::post('update/cart/quantity', [CartController::class, 'updateQuality'])->name('food.updateQuality');
Route::post('remove/cart/quantity', [CartController::class, 'removeQuality'])->name('food.removeQuality');

/*
|--------------------------------------------------------------------------
| User Section Routes 
|--------------------------------------------------------------------------
*/
Route::get('user/forgot/password', [HomeController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('user/forgot/password', [HomeController::class, 'sendResetPasswordLink'])->name('sendResetPasswordLink');
Route::get('user/reset/password/{otp}', [HomeController::class, 'resetPassword'])->name('resetPassword');
Route::put('update/user/password', [HomeController::class, 'updateUserPassword'])->name('updateUserPassword');
Route::get('admin/login', [AdminController::class, 'index'])->name('admin.login.view');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('email/verify/{otp}', [HomeController::class, 'emailVerification'])->name('emailVerification');

Route::get('user/registration', [UserController::class, 'registration'])->name('user.registration');
Route::get('user/login', [UserController::class, 'login'])->name('user.login');
Route::post('user/login', [UserController::class, 'userLogin'])->name('user.userLogin');
Route::post('user/signup', [UserController::class, 'create'])->name('user.create');

// Get State By Country 
Route::get('get/states/{id}', [HomeController::class, 'getStates'])->name('getStates');

// Get Cities By State
Route::get('get/cities/{id}', [HomeController::class, 'getCities'])->name('getCities');

/*
|--------------------------------------------------------------------------
| User Routes After Login With Middleware Security
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'user','middleware' => ['auth', 'user.check']], function () {
	Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
	Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
	Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
	Route::get('edit/profile', [UserController::class, 'editProfile'])->name('user.editProfile');
	Route::patch('update/profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
	Route::get('manage/password', [UserController::class, 'managePassword'])->name('user.managePassword');
	Route::get('setting', [UserController::class, 'setting'])->name('user.setting');
	Route::resource('address/book', AddressBookController::class);
	Route::get('address/set-as-default/{id}', [AddressBookController::class, 'setAsDefault'])->name('address.setAsDefault');
});


Route::group(['prefix' => 'admin','middleware' => ['auth', 'admin.check']], function () {

	// Admin Profile Related Routes
	Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
	Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
	Route::get('profile', [AdminController::class, 'show'])->name('admin.profile');
	Route::get('edit/profile', [AdminController::class, 'edit'])->name('admin.edit.profile');
	Route::post('update/profile', [AdminController::class, 'update'])->name('admin.update.profile');
	Route::post('update/basic/info', [AdminController::class, 'updateInfo'])->name('admin.updateInfo.profile');
	Route::post('update/social/links', [AdminController::class, 'updateSocialLinks'])->name('admin.updateSocialLinks.profile');

	// Settings Route Manage Header
	Route::get('manage/header', [SettingsController::class, 'manageHeader'])->name('admin.manageHeader');
	Route::patch('update/header', [SettingsController::class, 'updateHeader'])->name('admin.updateHeader');
	Route::put('update/header/permission', [SettingsController::class, 'updateHeaderPermission'])->name('admin.updateHeaderPermission');

	// Settings Route Manage Footer
	Route::get('manage/footer', [SettingsController::class, 'manageFooter'])->name('admin.manageFooter');
	Route::put('update/footer', [SettingsController::class, 'updateFooter'])->name('admin.updateFooter');

	// Promotional Banners Settings Routes
	Route::get('manage/promotional/banners', [SettingsController::class, 'managePromotionalBanners'])->name('admin.managePromotionalBanners');
	Route::get('add/promotional/banners', [SettingsController::class, 'addPromotionalBanners'])->name('admin.addPromotionalBanners');
	Route::post('create/promotional/banners', [SettingsController::class, 'createPromotionalBanners'])->name('admin.createPromotionalBanners');
	Route::get('edit/promotional/banners/{id}', [SettingsController::class, 'editPromotionalBanners'])->name('admin.editPromotionalBanners');
	Route::post('update/promotional/banners', [SettingsController::class, 'updatePromotionalBanners'])->name('admin.updatePromotionalBanners');
	Route::post('change-status/promotional/banners', [SettingsController::class, 'chnageStatusPromotionalBanners'])->name('admin.chnageStatusPromotionalBanners');
	Route::post('delete/promotional/banners', [SettingsController::class, 'deletePromotionalBanners'])->name('admin.deletePromotionalBanners');

	// Admin Feedback Routes
	Route::get('manage/feedback', [SettingsController::class, 'manageFeedback'])->name('admin.manageFeedback');
	Route::get('add/feedback', [SettingsController::class, 'addFeedback'])->name('admin.addFeedback');
	Route::post('create/feedback', [SettingsController::class, 'createFeedback'])->name('admin.createFeedback');
	Route::post('change-status/feedback', [SettingsController::class, 'changeStatusFeedback'])->name('admin.changeStatusFeedback');
	Route::post('delete/feedback', [SettingsController::class, 'deleteFeedback'])->name('admin.deleteFeedback');
	Route::get('update/feedback/{id}', [SettingsController::class, 'updateFeedbackView'])->name('admin.updateFeedbackView');
	Route::patch('update/feedback', [SettingsController::class, 'updateFeedback'])->name('admin.updateFeedback');

	// FAQ Management Routes
	Route::get('manage/faq', [SettingsController::class, 'manageFaq'])->name('admin.manageFaq');
	Route::get('add/faq', [SettingsController::class, 'addFaq'])->name('admin.addFaq');
	Route::post('create/faq', [SettingsController::class, 'createFaq'])->name('admin.createFaq');
	Route::get('update/faq/{id}', [SettingsController::class, 'updateFaqView'])->name('admin.updateFaqView');
	Route::put('update/faq', [SettingsController::class, 'updateFaq'])->name('admin.updateFaq');
	Route::delete('delete/faq/{id}', [SettingsController::class, 'deleteFaq'])->name('admin.deleteFaq');

	// Manage Qulaity Routes
	Route::get('manage/quality', [SettingsController::class, 'manageQuality'])->name('admin.manageQuality');
	Route::get('add/quality', [SettingsController::class, 'addQuality'])->name('admin.addQuality');
	Route::post('create/quality', [SettingsController::class, 'createQuality'])->name('admin.createQuality');
	Route::get('edit/quality/{id}', [SettingsController::class, 'editQuality'])->name('admin.editQuality');
	Route::put('update/quality', [SettingsController::class, 'updateQuality'])->name('admin.updateQuality');
	Route::delete('delete/quality/{id}', [SettingsController::class, 'deleteQuality'])->name('admin.deleteQuality');

	// Term, Policy, Refund & Cookie Content  Routes
	Route::get('manage/terms', [SettingsController::class, 'manageTerms'])->name('admin.manageTerms');
	Route::get('manage/policy', [SettingsController::class, 'managePolicy'])->name('admin.managePolicy');
	Route::get('manage/refund/content', [SettingsController::class, 'manageRefundContent'])->name('admin.manageRefundContent');
	Route::get('manage/cookie/content', [SettingsController::class, 'manageCookieContent'])->name('admin.manageCookieContent');
	Route::put('update/terms', [SettingsController::class, 'updateHomeContent'])->name('admin.updateHomeContent');

	// Upload CK Editor Images
	Route::post('editor/image/upload', [SettingsController::class, 'ckEditorImageUpload'])->name('admin.ckEditorImageUpload');

	// Email Template Routes
	Route::resource('email/template', EmailTemplateController::class);

	// Branch User Routes
	Route::resource('branch', BranchController::class);
	Route::delete('delete/branch/document/{id}', [BranchController::class, 'deleteDocument'])->name('admin.deleteDocument');

	// Send Email By Admin To User
	Route::post('send/email', [SettingsController::class, 'sendEmail'])->name('admin.sendEmail');
	// Send SMS By Admin To User
	Route::post('send/sms', [SettingsController::class, 'sendSMS'])->name('admin.sendSMS');
	Route::get('send/sms/view/{id}', [BranchController::class, 'sendSMSView'])->name('admin.sendSMSView');
	Route::get('send/email/view/{id}', [BranchController::class, 'sendEmailView'])->name('admin.sendEmailView');
	// Delete SMS History
	Route::delete('delete/sms/history/{id}', [BranchController::class, 'deleteSMSHistory'])->name('admin.deleteSMSHistory');
	Route::delete('delete/email/history/{id}', [BranchController::class, 'deleteEmailHistory'])->name('admin.deleteEmailHistory');
	// 
	Route::get('branch/update/password/{id}', [BranchController::class, 'updatePasswordViewView'])->name('admin.updatePasswordViewView');

	// Kitchen Related Routes
	Route::resource('kitchen', KitchenController::class);

	// Team Rlated Routes
	Route::resource('team', TeamController::class);

	// Category Related Routes
	Route::resource('category', CategoryController::class);
	Route::post('category/change-status', [CategoryController::class, 'changeStatus'])->name('admin.category.changeStatus');
	Route::get('manage/sub/categories/{id}', [CategoryController::class, 'manageSubCategories'])->name('admin.category.manageSubCategories');

	// Quantity Reated Routes
	Route::resource('quantity', QuantityController::class);

	// Post Related Routes
	Route::resource('post', PostController::class);

	// Gallery Related Routes
	Route::resource('gallery', GalleryController::class);

	// Gallery Category
	Route::resource('categories/gallery', GalleryCategoryController::class);
	Route::get('get/categories/gallery', [GalleryCategoryController::class, 'getCategories']);

	// Food Items Routes
	Route::resource('food/items', FoodItemController::class);
	Route::delete('food/items/delete/gallery/{id}', [FoodItemController::class, 'deleteFoodImage'])->name('admin.deleteFoodImage');
	Route::post('food/items/change-status', [FoodItemController::class, 'changeStatus'])->name('admin.food.changeStatus');
	Route::get('food/addons/{id}', [FoodItemController::class, 'addons'])->name('admin.food.addons');
	Route::post('food/addons', [FoodItemController::class, 'createAddons'])->name('admin.food.createAddons');

	// Food Ingredients Routes
	Route::resource('ingredients', IngredientController::class);


	// Deals Related Route
	Route::resource('deals', DealController::class);
	Route::post('deals/change-status', [DealController::class, 'changeStatus'])->name('admin.deal.changeStatus');
	// Coupons Related Route
	Route::resource('coupons', CouponController::class);
	Route::post('coupons/change-status', [CouponController::class, 'changeStatus'])->name('admin.deal.changeStatus');

	// About Section Routes
	Route::get('manage/about', [SettingsController::class, 'manageAbout'])->name('admin.manageAbout');
	Route::post('update/about', [SettingsController::class, 'updateAbout'])->name('admin.updateAbout');

	// Home Page Content Settings Page
	Route::get('manage/home/page/settings', [SettingsController::class, 'homePageSettings'])->name('admin.homePageSettings');
	Route::put('update/home/page/categories', [SettingsController::class, 'updateHomeCategories'])->name('admin.updateHomeCategories');
	Route::put('update/home/page/best_food', [SettingsController::class, 'updateHomeBestFood'])->name('admin.updateHomeBestFood');
	Route::put('update/home/page/popular/foods', [SettingsController::class, 'updatePopularFoods'])->name('admin.updatePopularFoods');
	Route::put('update/home/page/testimonial', [SettingsController::class, 'updateHomePageTestimonial'])->name('admin.updateHomePageTestimonial');
	Route::put('update/home/page/online/section', [SettingsController::class, 'updateHomePageOnlineSection'])->name('admin.updateHomePageOnlineSection');
	Route::put('update/home/gallery/content', [SettingsController::class, 'updateGalleryContent'])->name('admin.updateGalleryContent');
	Route::put('update/home/contact/content', [SettingsController::class, 'updateContactContent'])->name('admin.updateContactContent');


});

Route::group(['middleware' => ['auth']], function () {
	// Update User Password By Admin 
	Route::put('update/password', [SettingsController::class, 'updatePassword'])->name('updatePassword');
	// Get Sub Categories
	Route::get('sub/categories/{id}', [HomeController::class, 'getSubCategories'])->name('getSubCategories');
	Route::post('sub/categories', [HomeController::class, 'getSubCategoriesByArray'])->name('getSubCategoriesByArray');
	Route::post('get/food/items', [HomeController::class, 'foodItems'])->name('foodItems');
	Route::get('quantity/list', [HomeController::class, 'quantityList'])->name('quantityList');
	Route::post('update/password', [AdminController::class, 'updatePassword'])->name('admin.updatePassword.profile');
});

