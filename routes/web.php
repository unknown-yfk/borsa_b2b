<?php

use App\Models\user;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hoController;
use App\Http\Controllers\officerController;
use App\Http\Controllers\analyistController;


use App\Http\Controllers\QrController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\handoverController;
use App\Http\Controllers\delivery3Controller;

use App\Http\Controllers\handover2Controller;
use App\Http\Controllers\romProductManagment;
use App\Http\Controllers\ClientCartController;

use App\Http\Controllers\romProfileController;
use App\Http\Controllers\tm_profileController;

use App\Http\Controllers\rspProfileController;
use App\Http\Controllers\agentProfileController;
use App\Http\Controllers\deliverycartController;
use App\Http\Controllers\tm_dashboardController;
use App\Http\Controllers\clientProfileController;
use App\Http\Controllers\delivery2cartController;
use App\Http\Controllers\orderedProductsController;
use App\Http\Controllers\client_handover_controller;



use App\Http\Controllers\key_distroProductManagment;
use App\Http\Controllers\key_distroProfileController;
use App\Http\Controllers\key_distroDashboardController;
use App\Http\Controllers\ClientOrderedProductsController;


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

Route::group(['middleware'=>'language'], function () {
    Route::get('/', function () {

        return view('welcome');
    });
    Route::get('setlocale/{locale}', function($lang) {
    \Session::put('locale', $lang);
    return redirect()->back();
  });




Route::get('/', function () {
        //     $client = client::join('users','users.id', '=','clients.user_id')->count();
        // $client = client::join('users','users.id', '=','clients.user_id')->count();


        // $client =user::where('userType','client')->count();
        // $users = user::count() - 1;
        // $kds =user::where('userType','key distributor')->count();
        // $agents =user::where('userType','agent')->count();

        // $roms =user::where('userType','ROM')->count();
        // $rsps =user::where('userType','RSP')->count();
        // $total_sales=order::where('paymentStatus','confirm')->sum('totalPrice');

        // $userList=user::get();
        // $todaysOrders=order::where('createdDate',today())->count();
        // $totalOrders =order::count();

    return view('welcome');
    });
Auth::routes();
    Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth','verified'])->group(function(){
  //admin controler
  /* ************************************* Admin Routes ************************************************/

  Route::get('qr-code-g', function () {

    \QrCode::size(500)
            ->format('png')
            ->generate('12sdanwfafoaiwe');

  return view('admin.client_info');

});
  Route::get('/adminDashboard', [adminController::class, 'index'])->middleware('admin');
  Route::get('/admin/create/clients', [adminController::class, 'create_client'])->middleware('admin');
  Route::post('/admin/create/posts', [adminController::class, 'store_client'])->middleware('admin');
  Route::get('/admin/view/clients', [adminController::class, 'view_clients'])->middleware('admin');
  Route::get('/admin/view/clients/{id}',[adminController::class, 'Qrgenerator'])->middleware('admin');
  Route::get('/user/list', [adminController::class, 'newUserList'])->middleware('admin');
  Route::get('/admin/create/user',[adminController::class, 'create_user'])->middleware('admin');
  Route::post('/admin/create/user/post',[adminController::class, 'store_user'])->middleware('admin');
  Route::get('/admin/edit/user/{id}',[adminController::class, 'edit_user'])->middleware('admin');
  Route::post('/admin/editeduserStore/{id}',[adminController::class, 'edited_user_store'])->middleware('admin');
  Route::get('/admin/edit/client/{id}',[adminController::class, 'edit_client'])->middleware('admin');
  Route::post('/admin/editedclientStore/{id}',[adminController::class, 'edited_client_store'])->middleware('admin');


  Route::get('/admin/delete/user/{id}',[adminController::class, 'delete_user'])->middleware('admin');

  Route::get('/admin/create/tm',[adminController::class, 'create_tm'])->middleware('admin');
  Route::post('/admin/create/tm/post',[adminController::class, 'store_tm'])->middleware('admin');


  Route::get('/todays/orders', [adminController::class, 'orderIndex'])->middleware('admin');
  Route::get('/admin/order/history', [adminController::class, 'orderHistory'])->middleware('admin');
  Route::get('/admin/undelivered/orders', [adminController::class, 'undeliveredIndex'])->middleware('admin');
  Route::post('/admin/undelivered/order/details', [adminController::class, 'undeliveredDetails'])->middleware('admin');
  Route::get('/admin/payment/report', [report::class, 'adminPaymentReport'])->middleware('admin');
  Route::get('/admin/lastMile/report', [report::class, 'adminLastmileReport'])->middleware('admin');
  Route::get('/admin/OrderConformation/report', [report::class, 'adminKDOrderConformationReport'])->middleware('admin');
  Route::get('/admin/add/product', [adminController::class, 'add_product'])->middleware('admin');

  Route::post('/admin/StoreProducts', [adminController::class, 'store_product'])->middleware('admin');
  Route::get('/admin/view/product', [adminController::class, 'view_product'])->middleware('admin');
  Route::get('/admin/edit/product/{id}', [adminController::class, 'edit_product'])->middleware('admin');
  Route::get('/admin/edit/productlist/{id}', [adminController::class, 'edit_productlist'])->middleware('admin');

  Route::post('/admin/editedProductStore/{id}', [adminController::class, 'edited_product_store'])->middleware('admin');
  Route::post('/admin/editedProductlistStore/{id}', [adminController::class, 'edited_productlist_store'])->middleware('admin');
  Route::get('/admin/delete/product/{id}', [adminController::class, 'delete_product'])->middleware('admin');
  Route::get('/admin/delete/productlist/{id}', [adminController::class, 'delete_productlist'])->middleware('admin');
  Route::get('/admin/add/catagory', [adminController::class, 'add_catagory'])->middleware('admin');
  Route::post('/admin/StoreCatagories', [adminController::class, 'store_catagory'])->middleware('admin');
  Route::get('/admin/view/catagory', [adminController::class, 'view_catagory'])->middleware('admin');
  Route::get('/admin/edit/catagory/{id}', [adminController::class, 'edit_productCatagory'])->middleware('admin');
  Route::post('/admin/editedcatagoryStore/{id}', [adminController::class, 'edited_product_catagories'])->middleware('admin');
  Route::get('/admin/delete/catagory/{id}', [adminController::class, 'delete_ProductCatagory'])->middleware('admin');
  Route::get('/admin/add/ProductType', [adminController::class, 'add_productType'])->middleware('admin');
  Route::post('/admin/StoreProductTypes', [adminController::class, 'store_productType'])->middleware('admin');
  Route::get('/admin/view/ProductType', [adminController::class, 'view_ProductType'])->middleware('admin');
  Route::get('/admin/edit/productType/{id}', [adminController::class, 'edit_productType'])->middleware('admin');
  Route::post('/admin/editedProductTypeStore/{id}', [adminController::class, 'edited_productType_store'])->middleware('admin');
  Route::get('/admin/delete/productType/{id}', [adminController::class, 'delete_productType'])->middleware('admin');
  Route::post('/admin/user/activate/{id}',[adminController::class, 'activate_user'])->middleware('admin');
  Route::post('/admin/user/deactivate/{id}',[adminController::class, 'deactivate_user'])->middleware('admin');
  Route::get('/admin/user/changeStatus', [adminController::class, 'changeStatus'])->middleware('admin');
  Route::get('/admin/client/changestatus', [adminController::class, 'changeClientStatus'])->middleware('admin');


  Route::get('/admin/Order_hierarchy', [adminController::class, 'Order_hierarchy'])->name('hierarchy.index')->middleware('admin');

  Route::post('/admin/Order_hierarchy/store', [adminController::class, 'store_Order_hierarchy'])->middleware('admin');
  Route::get('/admin/hierarchy/changeStatus', [adminController::class, 'changeHierarchyStatus'])->middleware('admin');


Route::get('/admin/add/productlist', [adminController::class, 'add_product_list'])->middleware('admin');


Route::post('/admin/StoreProductsList', [adminController::class, 'store_productlist'])->middleware('admin');


Route::get('/admin/view/productlist', [adminController::class, 'view_productlist'])->middleware('admin');







Route::post('api/admin/fetch-productType', [adminController::class, 'fetchProductTypes'])->middleware('admin');
  /* *********************************   HO Routes *******************************************************    */
Route::get('/hoDashboard', [hoController::class, 'index'])->middleware('ho');

Route::get('/ho/lastMile/report', [report::class, 'hoLastmileReport'])->middleware('ho')->name('hoLastmileReport');
Route::get('/ho/lastMile/filterlastMile', [report::class, 'filterlastMile'])->middleware('ho');



Route::post('/ho/order/details', [orderedProductsController::class, 'orderDetailsho']);

Route::post('/ho/order/detailsreport', [orderedProductsController::class, 'orderDetailshoreport']);

Route::get('/ho/order/report', [report::class, 'hoorderReport'])->middleware('ho')->name('hoorderReport');
Route::get('/ho/order/filterorder', [report::class, 'filterorder'])->middleware('ho');


Route::get('/ho/onboarding/report', [report::class, 'hoonboardingReport'])->middleware('ho')->name('hoonboardingReport');
Route::get('/ho/onboarding/filteronboarding', [report::class, 'filteronboarding'])->middleware('ho');

Route::get('/ho/orderfulfilment/report', [report::class, 'hoorderfulfilmentReport'])->middleware('ho')->name('hoorderfulfilmentReport');
Route::get('/ho/fulfilment/filterOrders', [report::class, 'filterorders'])->middleware('ho');





Route::post('/ho/user/details', [hoController::class, 'userdetail']);



Route::get('/ho/productperagent/report', [report::class, 'hoproductperagentReport'])->middleware('ho')->name('hoproductperagentReport');
Route::get('/ho/product/filterperagent', [report::class, 'filterproductperagent'])->middleware('ho');



Route::get('/ho/productperloaction/report', [report::class, 'hoproductperloactionReport'])->middleware('ho')->name('hoproductperloactionReport');
Route::get('/ho/product/filterlocation', [report::class, 'filterproductperloaction'])->middleware('ho');


Route::get('/ho/productpersubloaction/report', [report::class, 'hoproductpersubloactionReport'])->middleware('ho')->name('hoproductpersubloactionReport');
Route::get('/ho/product/filtersublocation', [report::class, 'filterproductpersubloaction'])->middleware('ho');




// Route::post('/ho/order/detailstest', [report::class, 'test'])->name('approval.student.ajax.parent');
Route::get('/ho/product/report', [report::class, 'hoproductReport'])->middleware('ho')->name('hoproductReport');
Route::get('/ho/product/filterproduct', [report::class, 'filterproduct'])->middleware('ho');

Route::get('/ho/password/change', [hoController::class, 'change_password'])->name('ho_change_password')->middleware('ho');
Route::post('/ho/password/change/post', [hoController::class, 'update_password'])->middleware('ho');

 /* *********************************   analyist Routes *******************************************************    */
Route::get('/analyistDashboard', [analyistController::class, 'index'])->middleware('analyist');

Route::get('/analyist/view/clients', [analyistController::class, 'view_clients'])->middleware('analyist');
  Route::get('/analyist/edit/client/{id}',[analyistController::class, 'edit_client'])->middleware('analyist');
  Route::post('/analyist/editedclientStore/{id}',[analyistController::class, 'edited_client_store'])->middleware('analyist');

  Route::get('/analyist/user/list', [analyistController::class, 'newUserList'])->middleware('analyist');

  Route::get('/analyist/onboarding/report', [report::class, 'analyistonboardingReport'])->middleware('analyist');
Route::post('/analyist/user/details', [analyistController::class, 'userdetail']);

/* ************************************* Officer Route ************************************************/
Route::get('/officerDashboard', [officerController::class, 'index'])->middleware('officer');
Route::get('/officer/lastMile/report', [report::class, 'officerLastmileReport'])->middleware('officer');

Route::post('/officer/order/details', [orderedProductsController::class, 'orderDetailsofficer']);

Route::get('/officer/order/report', [report::class, 'officerorderReport'])->middleware('officer');
  /* *********************************   KD Routes *******************************************************    */
Route::get('/key_distroDashboard', [key_distroDashboardController::class, 'index'])->middleware('kd');
Route::get('/key_distroProfile/show', [key_distroProfileController::class, 'show'])->middleware('kd');
Route::get('/key_distro/create/post', [key_distroProfileController::class, 'create'])->middleware('kd');
Route::post('/key_distros/create/posts', [key_distroProfileController::class, 'store'])->middleware('kd');
Route::get('/key_distro/update/edit', [key_distroProfileController::class, 'edit'])->middleware('kd');
Route::put('/key_distro/update/edits', [key_distroProfileController::class, 'update'])->middleware('kd');
Route::get('/key_distro/password/change', [key_distroProfileController::class, 'change_password'])->name('kd_change_password')->middleware('kd');
Route::post('/key_distro/password/change/post', [key_distroProfileController::class, 'update_password'])->middleware('kd');
Route::get('/key_distro/report/order/accepted', [report::class, 'kdReportOrderAccepted'])->middleware('kd');
Route::get('/key_distro/report/handover', [report::class, 'kdReportHandOver'])->middleware('kd');
Route::post('/set_order_status', [orderedProductsController::class, 'set_order_status'])->middleware('kd');
Route::post('/kd/add/stock_store', [key_distroProductManagment::class, 'store_stock'])->middleware('kd');

Route::post('/kd_unconfirmed_details', [orderedProductsController::class, 'kd_unconfirmed_details'])->middleware('kd');
Route::post('/kd_confirmed_details', [orderedProductsController::class, 'kd_confirmed_details'])->middleware('kd');
Route::post('/kd_returned_details', [orderedProductsController::class, 'kd_returned_details'])->middleware('kd');

Route::put('/kd/return/accept', [orderedProductsController::class, 'kd_accept'])->middleware('kd');
Route::put('/kd/return/decline', [orderedProductsController::class, 'kd_decline'])->middleware('kd');









Route::get('/orders/show', [orderedProductsController::class, 'kdView'])->middleware('kd');
Route::get('/order/history', [orderedProductsController::class, 'orderHistory'])->middleware('kd');
Route::get('/order/returned', [orderedProductsController::class, 'returned_order'])->middleware('kd');

Route::get('/handover/history', [handoverController::class, 'kdHandoverIndex'])->middleware('kd');
Route::post('/handover/detail', [handoverController::class, 'kdHandoverDetails'])->middleware('kd');
Route::get('/undelivered/orders', [handoverController::class, 'kdUndeliveredIndex'])->middleware('kd');
Route::post('/undeliveredDetails', [handoverController::class, 'kdUndeliveredDetails'])->middleware('kd');
Route::get('/key_distro/add/product', [key_distroProductManagment::class, 'add_product'])->middleware('kd');

Route::post('kd/add/stock_store/{id}', [key_distroProductManagment::class, 'store_stock'])->middleware('kd');



Route::post('/key_distro/add/products/post', [key_distroProductManagment::class, 'store_product'])->middleware('kd');
Route::get('/key_distro/view/product', [key_distroProductManagment::class, 'view_product'])->middleware('kd');
Route::get('/key_distro/edit/product/{id}', [key_distroProductManagment::class, 'edit_product'])->middleware('kd');
Route::post('/key_distro/edit/product/post/{id}', [key_distroProductManagment::class, 'edited_product_store'])->middleware('kd');
Route::get('/key_distro/delete/product/post/{id}', [key_distroProductManagment::class, 'delete_product'])->middleware('kd');
Route::post('/handover1/post/nextpage', [handoverController::class, 'kdHandoverNextpage'])->middleware('kd');

Route::get('/key_distro/Handover_to_rom', [handoverController::class, 'Handover_to_rom'])->middleware('kd');
Route::post('/key_distro/Handover_to_rom/post', [handoverController::class, 'Handover_to_rom_post'])->middleware('kd');

Route::get('/key_distro/Handover_to_rsp', [handoverController::class, 'Handover_to_rsp'])->middleware('kd');
Route::get('/key_distro/Handover_to_client', [handoverController::class, 'Handover_to_client'])->middleware('kd');
Route::get('/key_distro/Handover_to_all', [handoverController::class, 'Handover_to_all'])->middleware('kd');


Route::get('/key_distro/client_pincode_verification', [handov7erController::class, 'pincode_verify'])->middleware('kd');
Route::post('/key_distro/client_pincode_verification/post', [handoverController::class, 'pinCode_verify_post'])->middleware('kd');





Route::get('/handover_to_client1/post/create', [handoverController::class, 'Handover_to_client_store'])->middleware('kd');
Route::get('/handover_to_rom1/post/create', [handoverController::class, 'Handover_to_rom_store'])->middleware('kd');
Route::get('/handover_to_rsp1/post/create', [handoverController::class, 'Handover_to_rsp_store'])->middleware('kd');


Route::post('/key_distro/fetch_rom_id/post', [handoverController::class, 'fetch_rom'])->middleware('kd');
Route::post('/key_distro/fetch_rsp_id/post', [handoverController::class, 'fetch_rsp'])->middleware('kd');
Route::post('/key_distro/fetch_client_id/post', [handoverController::class, 'fetch_client'])->middleware('kd');











// Route::get('dropdown', [DropdownController::class, 'index']);
Route::post('api/fetch-productType', [key_distroProductManagment::class, 'fetchProductType']);


//  Route::get('searchYourCity/{id}','Demolive_drop_down[email protected]');
// Route::post('/key_distro/edit/product/post/{id}', [key_distroProductManagment::class, 'getthecat'])->middleware('kd');



/***************************************TM routes****************** */




Route::get('/tmDashboard', [tm_dashboardController::class, 'index'])->middleware('tm');
Route::get('/tmProfile/show', [tm_profileController::class, 'show'])->middleware('tm');
Route::get('/tm/create/post', [tm_profileController::class, 'create'])->middleware('tm');
Route::post('/tm/create/posts', [tm_profileController::class, 'store'])->middleware('tm');
Route::get('/tm/update/edit', [tm_profileController::class, 'edit'])->middleware('tm');
Route::put('/tm/update/edits', [tm_profileController::class, 'update'])->middleware('tm');
Route::get('/tm/password/change', [tm_profileController::class, 'change_password'])->name('tm_change_password')->middleware('tm');
Route::post('/tm/password/change/post', [tm_profileController::class, 'update_password'])->middleware('tm');
Route::get('/tm/report/order/accepted', [report::class, 'tmReportOrderAccepted'])->middleware('tm');
Route::get('/tm/report/handover', [report::class, 'tmReportHandOver'])->middleware('tm');
Route::post('/set_order_status', [orderedProductsController::class, 'set_order_status'])->middleware('tm');
Route::post('/tm/add/stock_store', [key_distroProductManagment::class, 'store_stock'])->middleware('tm');

// Route::get('/tm/report/order/accepted', [report::class, 'tmReportOrderAccepted'])->middleware('kd');
// Route::get('/tm/report/handover', [report::class, 'tmReportHandOver'])->middleware('kd');

Route::post('/tm_unconfirmed_details', [orderedProductsController::class, 'tm_unconfirmed_details'])->middleware('tm');
Route::post('/tm_confirmed_details', [orderedProductsController::class, 'tm_confirmed_details'])->middleware('tm');
Route::post('/tm_returned_details', [orderedProductsController::class, 'tm_returned_details'])->middleware('tm');

Route::put('/tm/return/accept', [orderedProductsController::class, 'tm_accept'])->middleware('tm');
Route::put('/tm/return/decline', [orderedProductsController::class, 'tm_decline'])->middleware('tm');









Route::get('/tm/orders/show', [orderedProductsController::class, 'tmView'])->middleware('tm');
Route::get('/tm/order/history', [orderedProductsController::class, 'tm_orderHistory'])->middleware('tm');
Route::get('/order/returned', [orderedProductsController::class, 'returned_order'])->middleware('tm');

Route::get('/tm/handover/history', [handoverController::class, 'tmHandoverIndex'])->middleware('tm');
Route::post('/tm/handover/detail', [handoverController::class, 'tmHandoverDetails'])->middleware('tm');
Route::get('/tm/undelivered/orders', [handoverController::class, 'tmUndeliveredIndex'])->middleware('tm');
Route::post('tm/undeliveredDetails', [handoverController::class, 'tmUndeliveredDetails'])->middleware('tm');
Route::get('/tm/add/product', [key_distroProductManagment::class, 'add_product'])->middleware('tm');

Route::post('tm/add/stock_store/{id}', [key_distroProductManagment::class, 'store_stock'])->middleware('tm');



Route::post('/tm/add/products/post', [key_distroProductManagment::class, 'store_product'])->middleware('tm');
Route::get('/tm/view/product', [key_distroProductManagment::class, 'view_product'])->middleware('tm');
Route::get('/tm/edit/product/{id}', [key_distroProductManagment::class, 'edit_product'])->middleware('tm');
Route::post('/tm/edit/product/post/{id}', [key_distroProductManagment::class, 'edited_product_store'])->middleware('tm');
Route::get('/tm/delete/product/post/{id}', [key_distroProductManagment::class, 'delete_product'])->middleware('tm');
Route::post('/tm/handover1/post/nextpage', [handoverController::class, 'tmHandoverNextpage'])->middleware('tm');

Route::get('/tm/Handover_to_rom', [handoverController::class, 'tm_Handover_to_rom'])->middleware('tm');
Route::post('/tm/Handover_to_rom/post', [handoverController::class, 'tm_Handover_to_rom_post'])->middleware('tm');

Route::get('/tm/Handover_to_rsp', [handoverController::class, 'Handover_to_rsp'])->middleware('tm');
Route::get('/tm/Handover_to_client', [handoverController::class, 'Handover_to_client'])->middleware('tm');
Route::get('/tm/Handover_to_all', [handoverController::class, 'Handover_to_all'])->middleware('tm');


Route::get('/tm/client_pincode_verification', [handov7erController::class, 'pincode_verify'])->middleware('tm');
Route::post('/tm/client_pincode_verification/post', [handoverController::class, 'pinCode_verify_post'])->middleware('tm');





Route::get('/handover_to_client1/post/create', [handoverController::class, 'Handover_to_client_store'])->middleware('tm');
Route::get('/handover_to_rom1/post/create', [handoverController::class, 'tm_Handover_to_rom_store'])->middleware('tm');
Route::get('/handover_to_rsp1/post/create', [handoverController::class, 'Handover_to_rsp_store'])->middleware('tm');


Route::post('/tm/fetch_rom_id/post', [handoverController::class, 'tm_fetch_rom'])->middleware('tm');
Route::post('/tm/fetch_rsp_id/post', [handoverController::class, 'fetch_rsp'])->middleware('tm');
Route::post('/tm/fetch_client_id/post', [handoverController::class, 'fetch_client'])->middleware('tm');

Route::put('/tm/confirmOrder/update/edit', [orderedProductsController::class, 'tm_update']);










// Route::get('dropdown', [DropdownController::class, 'index']);
Route::post('api/fetch-productType', [key_distroProductManagment::class, 'fetchProductType']);










/**************************************ROM Routes ******************************************************* */
Route::get('/romDashboard', [romProfileController::class, 'index'])->middleware('rom');
Route::get('/rom/create', [romProfileController::class, 'create'])->middleware('rom');
Route::post('/rom/create/posts', [romProfileController::class, 'store'])->middleware('rom');
Route::get('/romProfile/show', [romProfileController::class, 'show'])->middleware('rom');
Route::get('/rom/update/edit', [romProfileController::class, 'edit'])->middleware('rom');
Route::put('/rom/update/edits', [romProfileController::class, 'update'])->middleware('rom');
Route::get('/rom/password/change', [romProfileController::class, 'change_password'])->name('rom_change_password')->middleware('rom');
Route::post('/rom/password/change/post', [romProfileController::class, 'update_password'])->middleware('rom');




Route::get('/rom/orders/show', [orderedProductsController::class, 'romView'])->middleware('rom');
Route::get('/rom/orders/history', [orderedProductsController::class, 'romViewhistory'])->middleware('rom');

Route::post('/rom_unconfirmed_details', [orderedProductsController::class, 'rom_unconfirmed_details'])->middleware('rom');
Route::post('/rom_orderhistory_details', [orderedProductsController::class, 'rom_order_history_details'])->middleware('rom');

Route::post('/rom_confirmed_details', [orderedProductsController::class, 'rom_confirmed_details'])->middleware('rom');
Route::post('/rom_returned_details', [orderedProductsController::class, 'rom_returned_details'])->middleware('rom');

Route::post('/ordered-products/{orderedProduct}/update-status', [OrderedProductsController::class, 'updateStatus'])->name('ordered-products.update-status');
Route::post('/ordered-products/confirm', [OrderedProductsController::class, 'confirm'])->name('ordered-products.confirm');

Route::put('/rom/return/accept', [orderedProductsController::class, 'rom_accept'])->middleware('rom');
Route::put('/rom/return/decline', [orderedProductsController::class, 'rom_decline'])->middleware('rom');

Route::get('/rom/order/returned', [orderedProductsController::class, 'rom_returned_order'])->middleware('rom');

Route::get('/rom/add/product', [romProductManagment::class, 'add_product'])->middleware('rom');
Route::post('/rom/StoreProducts', [romProductManagment::class, 'store_product'])->middleware('rom');
Route::get('/rom/view/product', [romProductManagment::class, 'view_product'])->middleware('rom');
Route::get('/rom/edit/product/{id}', [romProductManagment::class, 'edit_product'])->middleware('rom');
Route::post('/rom/edit/product/post/{id}', [romProductManagment::class, 'edited_product_store'])->middleware('rom');
Route::get('/rom/delete/product/post/{id}', [romProductManagment::class, 'delete_product'])->middleware('rom');




Route::get('/rom/report/handover/accepted', [report::class, 'romReportHanoveraccepted'])->middleware('rom');
Route::get('/rom/report/handover/delivered', [report::class, 'romReportHanoverdelivered'])->middleware('rom');
Route::get('/romUndeliveredOrders', [handover2Controller::class, 'romUndeliveredIndex'])->middleware('rom');
Route::get('/handover2/history', [handover2Controller::class, 'romHandoverIndex'])->middleware('rom');
Route::post('/handover2Details', [handover2Controller::class, 'romHandoverDetails'])->middleware('rom');
Route::get('/romUndeliveredOrders', [handover2Controller::class, 'romUndeliveredIndex'])->middleware('rom');
Route::post('/romUndeliveredDetails', [handover2Controller::class, 'romUndeliveredDetails'])->middleware('rom');
Route::get('/new/deliveries', [handoverController::class, 'romDeliveryIndex'])->middleware('rom');
Route::post('/rom/delivery/details', [handoverController::class, 'romDeliveryDetails'])->middleware('rom');
Route::post('/rom/new/delivery/details', [handoverController::class, 'rom_newDeliveryDetails'])->middleware('rom');
Route::get('/filter/clients', [handoverController::class, 'filter_deliveries'])->middleware('rom');


Route::get('/delivery_search', [handover2Controller::class, 'delivery_search'])->middleware('rom');
Route::post('/delivery_search/post', [handover2Controller::class, 'delivery_search_post'])->middleware('rom');

Route::get('/qrscanner', function() {
    return view('ROM.qr_scanner');
});

Route::post('/qr/scan', [QrController::class, 'scan'])->name('qr.scan');


Route::get('/get-bank-account/${bankSelect.value}', [handoverController::class, 'fetchclient_account_number'])->middleware('rom');


Route::get('/delivery/history', [handoverController::class, 'romDeliveryHistoryIndex'])->middleware('rom');

Route::post('/handover_to_clientrom/post/create', [handover2Controller::class, 'handover_to_clientrom'])->middleware('rom');
Route::post('/last_page', [handover2Controller::class, 'last_page'])->middleware('rom');


Route::get('/rom/client_pincode_verification', [handover2Controller::class, 'pincode_verify'])->middleware('rom');
Route::post('/rom/client_pincode_verification/post', [handover2Controller::class, 'pinCode_verify_post'])->middleware('rom');
Route::get('/rom/payment/', [handover2Controller::class, 'payment_page'])->middleware('rom');
Route::get('/process_payment/rom/', [handover2Controller::class, 'rom_processPayment']);


Route::get('/rom/product/report', [report::class, 'romproductReport'])->middleware('rom')->name('romproductReport');
Route::get('/rom/product/filterproduct', [report::class, 'filterproductrom'])->middleware('rom');

Route::get('/rom/productperagent/report', [report::class, 'romproductperagentReport'])->middleware('rom')->name('romproductperagentReport');
Route::get('/rom/product/filterperagent', [report::class, 'filterproductperagentrom'])->middleware('rom');


Route::get('/rom/productperloaction/report', [report::class, 'romproductperloactionReport'])->middleware('rom')->name('romproductperloactionReport');
Route::get('/rom/product/filterlocation', [report::class, 'filterproductperloactionrom'])->middleware('rom');



Route::get('/rom/productpersubloaction/report', [report::class, 'romproductpersubloactionReport'])->middleware('rom')->name('romproductpersubloactionReport');
Route::get('/rom/product/filtersublocation', [report::class, 'filterproductpersubloactionrom'])->middleware('rom');





/* ***************************************RSP Routes *********************************************/
Route::get('/rspDashboard', [rspProfileController::class, 'index']);
Route::get('/rsp/create', [rspProfileController::class, 'create']);
Route::post('/rsp/create/posts', [rspProfileController::class, 'store']);
Route::get('/rspProfile/{rom}', [rspProfileController::class, 'show']);
Route::get('/rsp/update/edit', [rspProfileController::class, 'edit']); //shows edit post form
Route::put('/rsp/update/edits', [rspProfileController::class, 'update']);
Route::get('/rspnewDeliveries', [handover2Controller::class, 'rspDeliveryIndex']);
Route::post('/rspDeliveryDetails', [handover2Controller::class, 'rspDeliveryDetails']);
/****************************Agent Routes *********************************************************/

Route::get('/agentDashboard', [agentProfileController::class, 'index'])->name('agent.dashboard')->middleware('agent');
Route::get('/agent/create/post', [agentProfileController::class, 'create'])->middleware('agent');
Route::post('/agent/create/posts', [agentprofileController::class, 'store'])->middleware('agent');
Route::get('/agent/update/edit', [agentProfileController::class, 'edit'])->middleware('agent'); //shows edit post form
Route::put('/agent/update/store', [agentProfileController::class, 'update'])->middleware('agent');
Route::get('/agent/password/change', [agentProfileController::class, 'change_password'])->name('agent_change_password')->middleware('agent');
Route::post('/agent/password/change/post', [agentProfileController::class, 'update_password'])->middleware('agent');
Route::get('/agentProfile/show', [agentProfileController::class, 'show'])->middleware('agent');
Route::get('/filter_client_id',[CartController::class,'filter_client_id'])->middleware('agent');
Route::post('/agent/fetch_client_info/post',[CartController::class,'fetch_client_info_post'])->middleware('agent');
Route::get('/agent/fetch_client_info',[CartController::class,'fetch_client_info'])->middleware('agent');
Route::get('/agent/order/details',[CartController::class,'agent_order_details'])->middleware('agent');
Route::put('/agent/confirmOrder/accept',[CartController::class,'accept'])->middleware('agent');
Route::put('/agent/confirmOrder/decline',[CartController::class,'decline'])->middleware('agent');








Route::get('/delivery3', [delivery3Controller::class, 'deliveryToClient'])->middleware('agent');
Route::post('/order/place', [CartController::class, 'ProductCatagoryList'])->middleware('agent');
// Route::get('/order/place', [CartController::class, 'ProductCatagoryList'])->middleware('agent');
Route::get('/ordertracking', [CartController::class, 'order_tracking'])->middleware('agent');
Route::post('/ordertracking/post', [CartController::class, 'order_tracking_post'])->middleware('agent');
Route::get('/clients_order_list', [CartController::class, 'clients_order_list'])->middleware('agent');




Route::get('product/category/{id}/{cli_id}', [CartController::class, 'productList'])->name('products.list')->middleware('agent');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list')->middleware('agent');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store')->middleware('agent');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update')->middleware('agent');
Route::post('/orderRemove', [CartController::class, 'removeCart'])->middleware('agent');
Route::post('/orderClear', [CartController::class, 'clearAllCart'])->middleware('agent');

Route::get('/agent/fetch_client/post', [CartController::class,'fetch_client_post'])->middleware('agent');
Route::get('/agent/fetch_client', [CartController::class, 'fetch_client']);





/* ***************************************Shared And Combo Routes *********************************************/
/*
Route::post('clear', [CartController::class, 'clearAllCart'])->name('orderCart.clear');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
*/
Route::post('/order/check/client', [orderedProductsController::class, 'clientCheck'])->name('checkClient');
Route::post('/order/check/client/submit', [orderedProductsController::class, 'clientCheckSubmit'])->name('checkClientSubmit');
Route::post('/client/order/post/create', [ClientOrderedProductsController::class, 'store'])->name('clientOrderProduct');
Route::post('/order/post/create', [orderedProductsController::class, 'store'])->name('orderProduct');

Route::get('/order/show', [orderedProductsController::class, 'index']);
Route::post('/order/details', [orderedProductsController::class, 'orderDetails']);
Route::post('/client/order/details', [clientOrderedProductsController::class, 'orderDetails']);

Route::put('/confirmOrder/update/edit', [orderedProductsController::class, 'update']);

Route::put('/confirmDelivery/update/edit', [handoverController::class, 'update'])->middleware('rom');
Route::put('/confirmDelivery2/update/edit', [handover2Controller::class, 'update']);

//handover controller
Route::post('/kd/handover', [handoverController::class, 'handover1'])->name('deliveryProduct.list')->middleware('kd');
Route::post('/handover1/post/create', [handoverController::class, 'store'])->middleware('kd');
Route::post('/rom/handover', [handover2Controller::class, 'handover2'])->middleware('rom');
Route::post('/handover2/post/create', [handover2Controller::class, 'storerom'])->middleware('rom');
Route::post('/kd/handover2/post/create', [handover2Controller::class, 'storekd'])->middleware('kd');
Route::get('/kd/payment/', [handoverController::class, 'payment_page'])->middleware('kd');
Route::post('/kd/process/payment/', [handoverController::class, 'processPayment'])->middleware('kd');




Route::get('/deliveryCartList', [deliverycartController::class, 'cartList'])->name('deliveryCart.list');
Route::get('/tm/deliveryCartList', [deliverycartController::class, 'tm_cartList'])->name('tmdeliveryCart.list');

Route::post('deliveryCartCreate', [deliverycartController::class, 'addToCart'])->name('deliveryCart.store');
Route::post('/delivery2CartList', [delivery2cartController::class, 'cartList'])->name('delivery2Cart.list');
Route::post('delivery2CartCreate', [delivery2cartController::class, 'addToCart'])->name('delivery2Cart.store');



Route::post('/delivered-products/{deliveredProduct}/update-status', [delivery2cartController::class, 'updateStatus'])->name('delivered-products.update-status');



Route::post('update-cart', [deliverycartController::class, 'updateCart'])->name('deliveryCart.update');
Route::post('/delivery1Remove', [deliverycartController::class, 'removeCart']);
Route::post('/delivery1clear', [deliverycartController::class, 'clearAllCart']);
Route::post('clear', [deliverycartController::class, 'clearAllCart'])->name('deliveryCart.clear');
Route::post('remove', [delivery2cartController::class, 'removeCart'])->name('delivery2Cart.remove');
Route::post('clear', [delivery2cartController::class, 'clearAllCart'])->name('delivery2Cart.clear');
Route::post('/order/post/create', [orderedProductsController::class, 'store']);





Route::get('/showOrders', [orderedProductsController::class, 'index']);
Route::get('/clientShowOrders', [ClientOrderedProductsController::class, 'index']);



//client and clientProfile controller routes




Route::get('/client_dash', [clientProfileController::class, 'index']);

Route::get('/client/create/post', [\App\Http\Controllers\clientController::class, 'create']);
Route::post('/client/create/posts', [\App\Http\Controllers\clientController::class, 'store']);
Route::get('/client/update/edit', [\App\Http\Controllers\clientProfileController::class, 'edit']); //shows edit post form
Route::put('/client/update/edits', [\App\Http\Controllers\clientProfileController::class, 'update']);
Route::get('/clientProfile/{client}', [\App\Http\Controllers\clientProfileController::class, 'show']);


Route::get('/client/new/deliveries', [client_handover_controller::class, 'clientDeliveryIndex']);
Route::post('/client/delivery/details', [client_handover_controller::class, 'clientDeliveryDetails']);
Route::get('/client/delivery/history', [client_handover_controller::class, 'clientDeliveryHistoryIndex']);
// Route::get('/client/handover2/history', [client_handover_controller::class, 'romHandoverIndex'])->middleware('client');
Route::put('/client/confirmDelivery/update/edit', [client_handover_controller::class, 'update']);
Route::post('/client/handover', [client_handover_controller::class, 'handover'])->middleware('client');
Route::post('/client/delivery/details/index', [client_handover_controller::class, 'clientDeliveryDetailsindex']);
Route::get('/client/order/show', [ClientOrderedProductsController::class, 'index']);

// Route::get('/agentDashboard', [agentProfileController::class, 'index'])->name('agent.dashboard');
Route::get('/client/create/post', [clientProfileController::class, 'create']);
Route::post('/client/create/posts', [clientProfileController::class, 'store']);
Route::get('/client/update/edit', [clientProfileController::class, 'edit']); //shows edit post form
Route::put('/client/update/store', [clientProfileController::class, 'update']);
Route::get('/client/password/change', [clientProfileController::class, 'change_password'])->name('client_change_password');
Route::post('/client/password/change/post', [clientProfileController::class, 'update_password']);
Route::get('/client/show', [clientProfileController::class, 'show']);
Route::get('/delivery3', [delivery3Controller::class, 'deliveryToClient']);
Route::get('client/order/place', [ClientCartController::class, 'clientProductCatagoryList']);
Route::get('client/product/category/{id}', [ClientCartController::class, 'clientproductList'])->name('clientProducts.list');
Route::get('clientCart', [ClientCartController::class, 'clientCartList'])->name('clientcart.list');
Route::post('clientcart', [ClientCartController::class, 'addToCart'])->name('clientcart.store');
Route::post('update-cart', [ClientCartController::class, 'updateCart'])->name('cart.update');
Route::post('/clientorderRemove', [ClientCartController::class, 'removeCart']);
Route::post('/orderClear', [CartController::class, 'clearAllCart']);
Route::get('/client/product/category/kdid/{id}/{kdid}', [ClientCartController::class, 'clientproductList_kd'])->name('clientProducts_kd.list');
Route::get('/client/ordertracking', [CartController::class, 'clientorder_tracking']);
Route::post('/client/ordertracking/post', [CartController::class, 'order_tracking_post']);
Route::get('/client/order/details',[CartController::class,'client_order_details']);
Route::put('/client/confirmOrder/accept',[CartController::class,'clientaccept']);
Route::put('/client/confirmOrder/decline',[CartController::class,'clientdecline']);

});

});




