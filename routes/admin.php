<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\SmsController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Backend\AccountsController;
use App\Http\Controllers\Backend\CampaingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ResellerController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\WithdrawController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\PaymentMethodController;

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


/*========================== Start Admin Route  ==========================*/
Route::get('/admin',[AdminController::class, 'Index'])->name('login_form');
Route::post('/admin',[AdminController::class, 'Login'])->name('admin.login');

// Admin All Routes
Route::prefix('admin')->middleware('admin')->group(function(){
	Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
	Route::get('/logout',[AdminController::class, 'AminLogout'])->name('admin.logout');
	Route::get('/register',[AdminController::class, 'AdminRegister'])->name('admin.regester');
	Route::post('/register/store',[AdminController::class, 'AdminRegisterStore'])->name('admin.register.store');
	Route::get('/forgot-password',[AdminController::class, 'AdminForgotPassword'])->name('admin.password.request');
	Route::get('/profile',[AdminController::class, 'Profile'])->name('admin.profile');
	Route::get('/edit/profile',[AdminController::class, 'EditProfile'])->name('edit.profile');
	Route::post('/store/profile',[AdminController::class, 'StoreProfile'])->name('store.profile');
	Route::get('/change/password',[AdminController::class, 'ChangePassword'])->name('change.password');
	Route::post('/update/password',[AdminController::class, 'UpdatePassword'])->name('update.password');

	/* ================ Admin Cache Clear ============== */
	Route::get('/cache-cache',[AdminController::class, 'clearCache'])->name('cache.clear');

	// ==================== Admin Brand All Routes ===================//
	Route::prefix('brand')->group(function(){
		Route::get('/view', [BrandController::class, 'BrandView'])->name('brand.all');
		Route::get('/add', [BrandController::class, 'BrandAdd'])->name('brand.add');
		Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
		Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
		Route::post('/update/{id}', [BrandController::class, 'BrandUpdate'])->name('brand.update');
		Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
		Route::get('/brand_active/{id}', [BrandController::class, 'active'])->name('brand.active');
		Route::get('/brand_inactive/{id}', [BrandController::class, 'inactive'])->name('brand.in_active');
	});

	// Admin Category All Routes
	Route::prefix('category')->group(function(){

		Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
		Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
		Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
		Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
		Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
		Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

		Route::get('/category_active/{id}', [CategoryController::class, 'active'])->name('category.active');
		Route::get('/category_inactive/{id}', [CategoryController::class, 'inactive'])->name('category.in_active');

		Route::get('/category_feature_status_change/{id}', [CategoryController::class, 'changeFeatureStatus'])->name('category.changeFeatureStatus');

	});

	// Admin Brand All Routes
	Route::prefix('supplier')->group(function(){
		Route::get('/view', [SupplierController::class, 'SupplierView'])->name('supplier.all');
		Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
		Route::post('/create', [SupplierController::class, 'store'])->name('supplier.store');
		Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
		Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
		Route::get('/delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
		Route::get('/supplier_active/{id}', [SupplierController::class, 'active'])->name('supplier.active');
		Route::get('/supplier_inactive/{id}', [SupplierController::class, 'inactive'])->name('supplier.in_active');
	});

	// Admin Tags All Routes
	Route::prefix('tag')->group(function(){
		Route::get('/view', [TagController::class, 'TagView'])->name('tag.all');
		Route::get('/add', [TagController::class, 'TagAdd'])->name('tag.add');
		Route::post('/store', [TagController::class, 'TagStore'])->name('tag.store');
		Route::get('/edit/{id}', [TagController::class, 'TagEdit'])->name('tag.edit');
		Route::post('/update/{id}', [TagController::class, 'TagUpdate'])->name('tag.update');
		Route::get('/delete/{id}', [TagController::class, 'TagDelete'])->name('tag.delete');
		Route::get('/tag_active/{id}', [TagController::class, 'active'])->name('tag.active');
		Route::get('/tag_inactive/{id}', [TagController::class, 'inactive'])->name('tag.in_active');

	});

	// Admin Product All Routes
	Route::prefix('product')->group(function(){
		Route::get('/view', [ProductController::class, 'ProductView'])->name('product.all');
		Route::get('/add', [ProductController::class, 'ProductAdd'])->name('product.add');
		Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product.store');
		Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');

		Route::post('/update/{id}', [ProductController::class, 'ProductUpdate'])->name('product.update');

		Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');

		Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');

		Route::get('/product_active/{id}', [ProductController::class, 'active'])->name('product.active');
		Route::get('/product_inactive/{id}', [ProductController::class, 'inactive'])->name('product.in_active');

		Route::get('/product_featured/{id}', [ProductController::class, 'featured'])->name('product.featured');

		// Add Attribute Add
		Route::post('/add-more-choice-option', [ProductController::class, 'add_more_choice_option'])->name('products.add-more-choice-option');

		// ajax product page //
		Route::get('/category/subcategory/ajax/{category_id}', [ProductController::class, 'GetSubProductCategory']);
		Route::get('/subcategory/minicategory/ajax/{subcategory_id}', [ProductController::class, 'GetSubSubCategory']);
	});


	// Admin Slider All Routes
	Route::resource('/slider', SliderController::class);
	Route::get('/slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
	Route::get('/slider_active/{id}', [SliderController::class, 'active'])->name('slider.active');
	Route::get('/slider_inactive/{id}', [SliderController::class, 'inactive'])->name('slider.in_active');

	// Admin Vendor All Routes
	Route::resource('/vendor', VendorController::class);
	Route::get('/vendor/delete/{id}', [VendorController::class, 'destroy'])->name('vendor.delete');
	Route::get('/vendor_active/{id}', [VendorController::class, 'active'])->name('vendor.active');
	Route::get('/vendor_inactive/{id}', [VendorController::class, 'inactive'])->name('vendor.in_active');

	// Admin Customer All Routes
	Route::resource('/customer', UserController::class);

	//Admin Campaign All Route
	Route::resource('/campaing', CampaingController::class);
	Route::get('/campaing/delete/{id}', [CampaingController::class, 'destroy'])->name('campaing.delete');
	Route::get('/campaing_active/{id}', [CampaingController::class, 'active'])->name('campaing.active');
	Route::get('/campaing_inactive/{id}', [CampaingController::class, 'inactive'])->name('campaing.in_active');

	Route::post('/flash_deals/product_discount', [CampaingController::class, 'product_discount'])->name('flash_deals.product_discount');
	Route::post('/flash-deals/product-discount-edit', [CampaingController::class, 'product_discount_edit'])->name('flash_deals.product_discount_edit');


	    // <--------- Banner route start ------>
	Route::resource('/banner', BannerController::class);
	Route::post('/banner/update/{id}', [BannerController::class, 'update'])->name('banner.update');
	Route::get('/banner/delete/{id}', [BannerController::class, 'destroy'])->name('banner.delete');
	Route::get('/banner_active/{id}', [BannerController::class, 'active'])->name('banner.active');
	Route::get('/banner_inactive/{id}', [BannerController::class, 'inactive'])->name('banner.in_active');

	// <--------- Blog route start ------>
	Route::resource('/blog', BlogController::class);
	Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
	Route::get('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
	Route::get('/blog_active/{id}', [BlogController::class, 'active'])->name('blog.active');
	Route::get('/blog_inactive/{id}', [BlogController::class, 'inactive'])->name('blog.in_active');

	// <--------- Page route start ------>
	Route::resource('/page', PageController::class);
	Route::get('/page/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
	Route::get('/page_active/{id}', [PageController::class, 'active'])->name('page.active');
	Route::get('/page_inactive/{id}', [PageController::class, 'inactive'])->name('page.in_active');

	// Attribute All Route
	Route::resource('/attribute', AttributeController::class);
	Route::get('/attribute/delete/{id}', [AttributeController::class, 'destroy'])->name('attribute.delete');

	// AttributeValue All Route
	Route::post('/attribute/value', [AttributeController::class, 'value_store'])->name('attribute.value_store');
	Route::get('/attribute/value/edit/{id}', [AttributeController::class, 'value_edit'])->name('attribute_value.edit');
	Route::post('/attribute/value/update/{id}', [AttributeController::class, 'value_update'])->name('attribute.val_update');
	Route::get('/attribute_value_active/{id}', [AttributeController::class, 'value_active'])->name('attribute_value.active');
	Route::get('/attribute_value_inactive/{id}', [AttributeController::class, 'value_inactive'])->name('attribute_value.in_active');
	Route::get('/attribute/value/delete/{id}', [AttributeController::class, 'value_destroy'])->name('attribute_value.delete');

	//Unit All Route
	Route::get('/unit', [AttributeController::class, 'index_unit'])->name('unit.index');
	Route::get('/unit/create', [AttributeController::class, 'create_unit'])->name('unit.create');
	Route::post('/unit/store', [AttributeController::class, 'store_unit'])->name('unit.store');
	Route::get('/unit/edit/{id}', [AttributeController::class, 'edit_unit'])->name('unit.edit');
	Route::post('/unit/update/{id}', [AttributeController::class, 'update_unit'])->name('unit.update');
	Route::get('/unit/delete/{id}', [AttributeController::class, 'destroy_unit'])->name('unit.delete');
	Route::get('/unit-status/{id}', [AttributeController::class, 'changeStatus'])->name('unit.changeStatus');


	// Setting All Route
	Route::get('/settings/index', [SettingController::class, 'index'])->name('setting.index');
	Route::post('/settings/update', [SettingController::class, 'update'])->name('update.setting');
	Route::get('/settings/activation', [SettingController::class, 'activation'])->name('setting.activation');

	// Shipping Methods Route
	Route::get('/shipping/index', [ShippingController::class, 'index'])->name('shipping.index');
	Route::get('/shipping/create', [ShippingController::class, 'create'])->name('shipping.create');
	Route::post('/shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
	Route::get('/shipping/edit/{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
	Route::post('/shipping/update/{id}', [ShippingController::class, 'update'])->name('shipping.update');
	Route::get('/shipping/delete/{id}', [ShippingController::class, 'destroy'])->name('shipping.delete');
	Route::get('/shipping_active/{id}', [ShippingController::class, 'active'])->name('shipping.active');
	Route::get('/shipping_inactive/{id}', [ShippingController::class, 'inactive'])->name('shipping.in_active');

	Route::get('/attributes/combination', [AttributeController::class, 'combination'])->name('combination.index');

	// Payment Methods Route
	Route::get('/payment-methods/configuration', [PaymentMethodController::class, 'index'])->name('paymentMethod.config');
	Route::post('/payment-methods/update', [PaymentMethodController::class, 'update'])->name('paymentMethod.update');


	Route::prefix('orders')->group(function(){
		// Orders All Route
		Route::get('/all_orders', [OrderController::class, 'index'])->name('all_orders.index');
		Route::get('/all_orders/pos_sale_index', [OrderController::class, 'index2'])->name('all_orders.pos_sale_index');
		Route::get('/all_orders/{id}/show', [OrderController::class, 'show'])->name('all_orders.show');
		Route::get('/all_orders/{id}/reseller/show', [OrderController::class, 'reseller_show'])->name('all_orders.reseller_show');
		Route::get('/all_orders/all_vendor_sale_index', [OrderController::class, 'AllvendorSellView'])->name('all_orders.all_vendor_sale_index');
        Route::get('/all_orders/vendor_sale_index', [OrderController::class, 'vendorSellView'])->name('all_orders.vendor_sale_index');
		Route::get('/orders_delete/{id}', [OrderController::class, 'destroy'])->name('delete.orders');
		Route::post('/orders_update/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
		Route::get('/invoice/{id}', [OrderController::class, 'invoice_download'])->name('invoice.download');
		Route::get('/print/invoice/{order}', [OrderController::class, 'invoice_print_download'])->name('print.invoice.download');
		Route::get('/reseller/print/invoice/{order}', [OrderController::class, 'reseller_invoice_print_download'])->name('reseller.print.invoice.download');
		Route::get('/vendor/show_status/{id}', [OrderController::class, 'vendor_show_status'])->name('vendor.showStatus');
        Route::get('/order/product/courierSend', [OrderController::class, 'order_product_courierSend'])->name('order.product.courierSend');
        Route::get('/all_orders/all_reseller_sale_index', [OrderController::class, 'AllresellerSellView'])->name('all_orders.all_reseller_sale_index');
	});

	// payment status
	Route::post('/orders/update_payment_status', [OrderController::class, 'update_payment_status'])->name('orders.update_payment_status');
	// delivery status
	Route::post('/orders/update_delivery_status', [OrderController::class, 'update_delivery_status'])->name('orders.update_delivery_status');

	// Report All Route
	Route::get('/stock_report', [ReportController::class, 'index'])->name('stock_report.index');
	Route::get('/profit-report', [ReportController::class, 'profitReport'])->name('profit.report');

	/*================  Admin Address Updated  ==================*/
	Route::post('/address/update/{id}', [OrderController::class, 'admin_address_update'])->name('admin.address.update');
	/*================  Admin User Updated  ==================*/
	Route::post('/user/update/{id}', [OrderController::class, 'admin_user_update'])->name('admin.user.update');
	/*================  Ajax  ==================*/
	Route::get('/division-district/ajax/{division_id}',[OrderController::class,'getdivision'])->name('division.ajax');
	Route::get('/district-upazilla/ajax/{district_id}',[OrderController::class,'getupazilla'])->name('upazilla.ajax');
	/*================  Ajax  ==================*/

	/*================  Ajax Category Store ==================*/
	Route::post('/category/insert',[ProductController::class,'categoryInsert'])->name('category.ajax.store');
	/*================  Ajax Brand Store ==================*/
	Route::post('/brand/insert',[ProductController::class,'brandInsert'])->name('brand.ajax.store');

	// <--------- Coupon route start ------>
	Route::resource('/coupons', CouponController::class);
	Route::post('/coupon/update/{id}', [CouponController::class, 'update'])->name('coupons.update');
	Route::get('/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');
	Route::get('/coupon_active/{id}', [CouponController::class, 'active'])->name('coupon.active');
	Route::get('/coupon_inactive/{id}', [CouponController::class, 'inactive'])->name('coupon.in_active');

	// sms-templates //
	Route::get('/sms-templates', [SmsController::class, 'template_index'])->name('sms.templates');
	Route::post('/sms-templates/store', [SmsController::class, 'store'])->name('sms.templates.store');
	Route::post('/sms-templates/update/{template_id}', [SmsController::class, 'template_update'])->name('sms.templates.update');

	// sms-providers //
	Route::get('/sms-providers', [SmsController::class, 'provider_index'])->name('sms.providers');
	Route::post('/sms-providers/store', [SmsController::class, 'providersStore'])->name('sms.providers.store');
	Route::post('/sms-providers/update/{provider_id}', [SmsController::class, 'provider_update'])->name('sms.providers.update');

	// role premissions //
	Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
	Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
	Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
	Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
	Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
	Route::get('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

	// role premissions staffs //
	Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
	Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
	Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
	Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
	Route::post('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
	Route::get('/staff/delete/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

	//Subscribers
	Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
	Route::get('/subscribers/destroy/{id}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');

	// Admin Accounting All Routes
	Route::prefix('accounts')->group(function(){
		Route::get('/account-heads', [AccountsController::class, 'heads'])->name('accounts.heads');
		Route::get('/account-heads/create', [AccountsController::class, 'create_head'])->name('accounts.heads.create');
		Route::post('/account-heads/store', [AccountsController::class, 'store_head'])->name('accounts.heads.store');
		Route::get('/account-heads/change-status/{id}', [AccountsController::class, 'change_status_head'])->name('accounts.heads.change_status');
		Route::get('/account-heads/delete/{id}', [AccountsController::class, 'head_destroy'])->name('accounts.heads.delete');
		Route::get('/account-ledgers', [AccountsController::class, 'ledgers'])->name('accounts.ledgers');
		Route::get('/account-ledgers/create', [AccountsController::class, 'create_ledger'])->name('accounts.ledgers.create');
		Route::post('/account-ledgers/store', [AccountsController::class, 'store_ledger'])->name('accounts.ledgers.store');
		Route::post('/account-ledgers/report', [AccountsController::class, 'ledger_report'])->name('accounts.leagers.report');
		Route::get('/account-ledgers/report/print', [AccountsController::class, 'ledger_report_print'])->name('accounts.ledgers.report_print');
		Route::get('/account-ledgers/delete/{id}', [AccountsController::class, 'ledger_destroy'])->name('accounts.ledgers.delete');
	});

	/*================  Ajax Customer Store ==================*/
	Route::post('/pos/customer/insert',[PosController::class,'customerInsert'])->name('customer.ajax.store.pos');

	//Admin POS All Routes
	/*Route::prefix('pos')->group(function(){
		Route::get('/', [PosController::class, 'index'])->name('pos.index');
		Route::get('/product/{id}', [PosController::class, 'getProduct'])->name('pos.getProduct');
		Route::get('/get-products', [PosController::class, 'filter'])->name('pos.filter');
		Route::POST('/store', [PosController::class, 'store'])->name('pos.store');
		Route::get('/barcode-product/{id}',[PosController::class,'barcode_ajax'])->name('barcode.ajax');
		Route::get('/barcode-product-search/{id}',[PosController::class,'barcode_search_ajax'])->name('barcode.search.ajax');
	});*/

	//Reseller
	Route::prefix('reseller')->group(function(){
		Route::get('/', [ResellerController::class, 'index'])->name('reseller.index');
		Route::get('/details/{id}', [ResellerController::class, 'show'])->name('reseller.show');
		Route::get('/requests', [ResellerController::class, 'requests'])->name('reseller.requests');
		Route::get('/create', [ResellerController::class, 'create'])->name('reseller.create');
		Route::post('/store', [ResellerController::class, 'store'])->name('reseller.store');
		Route::get('/approve/{id}', [ResellerController::class, 'approve'])->name('reseller.approve');
		Route::get('/change-status/{id}', [ResellerController::class, 'changeStatus'])->name('reseller.changeStatus');
		Route::get('/edit/{id}', [ResellerController::class, 'edit'])->name('reseller.edit');
		Route::post('/update/{id}', [ResellerController::class, 'update'])->name('reseller.update');
		Route::get('/delete/{id}', [ResellerController::class, 'destroy'])->name('reseller.delete');
	});
    //pos
    Route::prefix('pos')->group(function(){
		Route::get('/', [PosController::class, 'index'])->name('pos.index');
		Route::get('/product/{id}', [PosController::class, 'getProduct'])->name('pos.getProduct');
		Route::get('/get-products', [PosController::class, 'filter'])->name('pos.filter');
		Route::POST('/store', [PosController::class, 'store'])->name('pos.store');
        Route::get('add-to-cart/product',[PosController::class, 'add_pos_product'])->name('add.pos.product');
        Route::get('get-pos-cart/product',[PosController::class, 'getPosCartData'])->name('get.pos.CartData');
        Route::get('/pos/delete/{id}', [PosController::class, 'posdelete'])->name('pos.delete.item');
		Route::get('/pos/cart/update', [PosController::class, 'updatePosCart'])->name('pos.cart.update');
	});

    //cash withdraw
		Route::get('/Bkash',[WithdrawController::class,'Bkash'])->name('bkash');
		Route::get('/Nagad',[WithdrawController::class,'Nagad'])->name('nagad');
		Route::get('/Bank',[WithdrawController::class,'Bank'])->name('bank');
		Route::get('/cash',[WithdrawController::class,'Cash'])->name('cash');
		Route::get('/withdraw/status/{id}',[WithdrawController::class,'withdrawStatus'])->name('withdraw.status');
		Route::get('/withdraw-history',[WithdrawController::class,'withdraw_history'])->name('withdraw.history');

        //Reating & Review
        Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
        Route::get('/review/destroy/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
        Route::get('/review_active/{id}', [ReviewController::class, 'active'])->name('review.active');
        Route::get('/review_inactive/{id}', [ReviewController::class, 'inactive'])->name('review.in_active');

});

/*========================== End Admin Route  ==========================*/

require __DIR__.'/auth.php';
