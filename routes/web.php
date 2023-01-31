<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/', [FrontendController::class, 'index']);
// Route::get('/collections', [FrontendController::class, 'categories']);
// Route::get('/collections/{category_slug}', [FrontendController::class, 'products']);
// Route::get('/collections/{category_slug}/{product_slug}', [FrontendController::class, 'productview']);
// Routes Frontend Controller
Route::controller(FrontendController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/collections', 'categories');
    Route::get('/collections/{category_slug}', 'products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productview');

    Route::get('/new-arrivals', 'newArrivals');
    Route::get('/featured-products', 'featuredProducts');
    
    Route::get('/search', 'searchProducts');

});

Route::middleware('auth')->group(function() {
    Route::get('/wishlist', [WishlistController::class, 'index']);
    
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/checkout', [CheckoutController::class, 'index']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{order_id}', [OrderController::class, 'show']);
    
    Route::get('/profile', [UserController::class, 'index']);
    Route::post('/profile', [UserController::class, 'updateUserDetails']);

    Route::get('/change-password', [UserController::class, 'changePassword']);
    Route::post('/change-password', [UserController::class, 'updatePassword']);
});

Route::get('/thank-you', [FrontendController::class, 'thankyou']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'IsAdmin'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Routes Category Controller
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
    });

    Route::get('/brand', App\Http\Livewire\Admin\Brand\Index::class);

    // Routes Product Controller
    Route::controller(ProductController::class)->group(function(){
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('products/{product_id}/delete', 'destroy');

        Route::get('/product-image/{product_image_id}/delete', 'destroyImage');
        Route::post('/product-color/{prod_color_id}', 'updateProdColorQty');
        Route::get('/product-color/{prod_color_id}/delete', 'deleteProdColor');
    });
    
    // Routes Color Controller
    Route::controller(ColorController::class)->group(function(){
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors', 'store');
        Route::get('/colors/{color}/edit', 'edit');
        Route::put('/colors/{color_id}', 'update');
        Route::get('/colors/{color_id}/delete', 'destroy');
    });

    // Routes Slider Controller
    Route::controller(SliderController::class)->group(function(){
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/{slider}/delete', 'destroy');
    });

    // Routes Order Controller
    Route::controller(AdminOrderController::class)->group(function(){
        Route::get('/orders', 'index');
        Route::get('/orders/{order_id}', 'show');
        Route::put('/orders/{order_id}', 'updateOrderStatus');
        Route::get('/invoice/{order_id}', 'viewInvoice');
        Route::get('/invoice/{order_id}/generate', 'generateInvoice');
        Route::get('/invoice/{order_id}/mail', 'mailInvoice');
    });

    // Routes Setting Controller
    Route::controller(SettingController::class)->group(function(){
        Route::get('/settings', 'index');
        Route::post('/settings', 'store');
    });
    
    // User Controller Controller
    Route::controller(AdminUserController::class)->group(function(){
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{user_id}/edit', 'edit');
        Route::put('/users/{user_id}', 'update');
        Route::get('/users/{user_id}/delete', 'destroy');
    });
});
