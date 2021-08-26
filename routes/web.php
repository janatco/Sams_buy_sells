<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\shoppingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
   // dd(Auth::User()==null);
    if(Auth::User()==null){
        return view('welcome');

    }else{
        return redirect('/home');
    }


});

Route::get('/blacklisted', function () {
    return view('error');
});

Route::get('/shoppingcart', function(){

});

Route::get('/productbuy', function(){
    return view('productBuy');
});
//Route::get('/admin', function(){
    //return view('admin.admin_dashboard');
//});

Route::get('/admin', function(){
    return view('admin.admin_dashboard');
});
Route::get('/modify_admin', function(){
    return view('admin.modify_admin');
});
Route::get('/admin_change_password', function(){
    return view('admin./admin_change_password');
});
Route::get('/add_admin', function(){
    return view('admin.add_admin');
});

Route::get('/modify_user', function(){
    return view('admin.modify_user');
});
Route::get('/password', function(){
    return view('admin.password');
});

Route::get('/auctions_admin', function(){
    return view('admin.auctions_admin');
});

Route::get('/error', function(){
    return view('error');
});



Route::get('/admin', [App\Http\Controllers\adminController::class, 'index'])->name('admin');
Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [App\Http\Controllers\ProductController::class, 'loadProducts'])->name('home');
Route::get('/shopping', [App\Http\Controllers\shoppingController::class, 'index'])->name('shop');
Route::get('/buyproduct/{productKey}', [App\Http\Controllers\shoppingController::class, 'bidproduct'])->name('buyproduct');

Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');


Route::get('/home', [App\Http\Controllers\ProductController::class, 'loadProducts'])->name('home')->middleware('checkStatus');
//Route::get('loginCustom', [App\Http\Controllers\Auth\LoginController::class, 'loginCustom'])->name('loginCustom');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/feePay', [App\Http\Controllers\PaymentGateWayController::class, 'paymentGateWay']);
Route::any('/startBid', [App\Http\Controllers\BidController::class, 'store'])->name('startBid');
Route::post('/feePayment', [App\Http\Controllers\PaymentGateWayController::class, 'paymentFee'])->name('feePayment');
Route::post('/awarad', [App\Http\Controllers\BidController::class, 'awarad'])->name('awarad');
Route::post('/madeDepositPay', [App\Http\Controllers\PaymentGateWayController::class, 'madeDepositPay'])->name('madeDepositPay');
Route::get('/addProduct', [App\Http\Controllers\ProductController::class, 'create'])->name('addProduct');
Route::post('/storeProduct', [App\Http\Controllers\ProductController::class, 'store'])->name('addtoauction');
Route::get('/search/{name}', [App\Http\Controllers\ProductController::class, 'searchByName']);
Route::get('/getProductDetails/{key}', [App\Http\Controllers\ProductController::class, 'show']);
Route::get('/viewProduct/{key}', [App\Http\Controllers\ProductController::class, 'viewProduct']);
Route::get('/viewMyProducts', [App\Http\Controllers\ProductController::class, 'viewMyProducts']);
Route::get('/userDashboard', [App\Http\Controllers\ProductController::class, 'viewMyProducts']);
Route::get('/addMoreImages/{key}', [App\Http\Controllers\ProductController::class, 'addMoreImages']);
Route::post('/storeMoreImages', [App\Http\Controllers\ProductController::class, 'storeMoreImages'])->name('storeMoreImages');
Route::get('/cancellBid/{id}', [App\Http\Controllers\BidController::class, 'cancellBid']);
Route::get('/admin/blockUser/{id}', [App\Http\Controllers\adminController::class, 'userStatusToBlackList']);
Route::get('/admin/unBlock/{id}', [App\Http\Controllers\adminController::class, 'userUnblock']);
Route::get('/user_details', [App\Http\Controllers\adminController::class, 'viewBlackListUser']);
Route::get('/user_complaints/{id}', [App\Http\Controllers\adminController::class, 'viewComplaints']);
Route::get('/product_details', [App\Http\Controllers\adminController::class, 'viewProductDetails']);
Route::get('/bids_admin', [App\Http\Controllers\adminController::class, 'viewAllBids']);
Route::get('/transactions_admin', [App\Http\Controllers\adminController::class, 'viewAllTransactions']);
Route::get('/user_feedback_admin', [App\Http\Controllers\adminController::class, 'viewAllComplaints']);

Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from Sams and Sams Title',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('janarthanbit@gmail.com')->send(new \App\Mail\MyMail($details));

    dd("Email is Sent.");
});

// Added by LaHiRu
Route::get('message-box',[\App\Http\Controllers\MessageController::class,'inbox'])->name('inbox');

