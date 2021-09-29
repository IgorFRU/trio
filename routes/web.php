<?php

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

Route::middleware('blockip')->group(function(){
  Route::get('/', 'MainController@index')->middleware('currencyrates')->name('index');

  Route::get('/catalog/product/{product}', 'MainController@product2')->middleware('currencyrates')->name('product.without_category');
  Route::get('/catalog', 'MainController@categories')->middleware('currencyrates')->name('categories');
  Route::get('/catalog/{category}', 'MainController@category')->middleware('currencyrates')->name('category');
  Route::get('/catalog/{category}/{product}', 'MainController@product')->middleware('currencyrates')->name('product');

  Route::get('/articles', 'MainController@articles')->name('articles');
  Route::get('/articles/{article}', 'MainController@article')->name('article');

  Route::get('/sets', 'MainController@sets')->name('sets');
  Route::get('/sets/{set}', 'MainController@set')->name('set');

  Route::get('/sales', 'MainController@sales')->name('sales');
  Route::get('/sales/{sale}', 'MainController@sale')->name('sale');

  Route::get('/manufacture', 'MainController@manufactures')->name('manufactures');
  Route::get('/manufacture/{manufacture}', 'MainController@manufacture')->name('manufacture');

  Route::get('/questions', 'MainController@questions')->name('questions');
  Route::post('/questions/send', 'MainController@questionsStore')->name('send.question')->middleware('throttle:10,1');

  Route::post('/productsort', 'MainController@productSort');

  Route::post('/cart', 'CartController@addItems');
  Route::post('/cart/change', 'CartController@changeQuantity'); // ajax change quantity of item in cart
  Route::delete('/cart/{id}', 'CartController@destroyItem')->name('cart.destroy');
  Route::get('/cart', 'CartController@showCart')->name('cart');

  Route::resource('/order', 'OrderController')->except(['show']);
  Route::get('/order/{order}', 'OrderController@showOrder')->name('orderShow');
  Route::post('/order/checkuserphone', 'OrderController@checkUserPhone')->name('checkUserPhone');
  Route::post('/checkinn', 'OrderController@checkinn'); // ajax
  // Route::post('/order/final', 'OrderController@final')->name('order.final');

  Route::post('/firm/store', 'FirmController@firmStore');

  Route::get('/home', 'UserController@index')->name('home');

  Route::get('/send-question', 'SendmailController@question')->name('send_question');

  Route::get('/sitemap.xml', 'MainController@sitemap')->name('sitemap');
  Route::get('/oneclick-purcache', 'SendmailController@oneclick')->name('oneclick_purcache');
});

Route::prefix('admin')->name('admin.')->group(function(){
  Route::get('/', 'AdminController@index')->name('index');
  Route::post('/settings/{id}', 'AdminController@settings')->name('settings');
  Route::get('/login/{token?}', 'Auth\AdminLoginController@showLoginForm')->name('login')->middleware('check.url.login.token');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');
  Route::post('/logout', 'Auth\AdminLoginController@adminLogout')->name('logout');

  Route::get('/settings/clearcache', 'SettingController@clearCache')->name('clearcache'); // очистка всего кеша
  Route::get('/settings/migrate', 'SettingController@migrate')->name('migrate');
    
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');    
  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');    
  Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');  
  Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');
  
  Route::post('/properties/store',  'PropertyController@store');
  Route::post('/properties/destroy',  'PropertyController@destroy');
  Route::post('/uploadimg',  'ImageController@store');
  // Route::any('/updateimg/{id}',  'ImageController@update');
  Route::resource('/categories', 'CategoryController');
  Route::resource('/articles', 'ArticleController');
  Route::resource('/sets', 'SetController');
  Route::resource('/currencies', 'CurrencyController');
  Route::resource('/menus', 'MenuController');
  Route::post('/articles/addProducts', 'ArticleController@addProducts');
  Route::resource('/manufactures', 'ManufactureController');
  Route::resource('/blockip', 'BlackIpController');
  Route::resource('/products', 'ProductController');
  Route::post('/products/search', 'ProductController@search');
  Route::post('/products/massdestroy', 'ProductController@massDestroy')->name('products.massdestroy');
  Route::post('/products/published', 'ProductController@published')->name('products.published');
  Route::post('/products/massedit', 'ProductController@massedit')->name('products.massedit');
  Route::post('/products/copy', 'ProductController@copy')->name('products.copy');
  Route::post('/products/unimported', 'ProductController@unimported')->name('products.unimported');
  Route::post('/products/store/ajax', 'ProductController@storeAjax')->name('products.storeAjax');
  Route::post('/products/search/ajax', 'ProductController@ajaxSearch'); // поиск товара для добавления к статье
  Route::post('/products/fastpriceedit/ajax', 'ProductController@ajaxFastPriceEdit'); // поиск товара для добавления к статье
  Route::get('/products/addImages/{product}', 'ProductController@addImages')->name('products.addImages');
  Route::post('/products/getcategoryproperties', 'ProductController@getCategoryProperties'); // во время создания товара при изменении категории подтягиваются параметры
  Route::resource('/units', 'UnitController');
  Route::resource('/options', 'OptionController');
  Route::resource('/choises', 'ChoiseController');
  Route::post('/choises/savevalue', 'ChoisevalueController@store');
  Route::resource('/vendors', 'VendorController');
  Route::get('/discounts/archive', 'DiscountController@archive')->name('discounts.archive');
  Route::resource('/discounts', 'DiscountController');
  Route::any('/productimg', 'UploadImagesController@product')->name('product.image.upload');
  Route::resource('/topmenu', 'TopmenuController');  

  Route::resource('/questions', 'QuestionController');
  Route::post('/questions/ajax_get', 'QuestionController@ajaxGet');
  Route::post('/questions/ajax_update', 'QuestionController@ajaxUpdate');
  Route::post('/questions/ajax_answer', 'QuestionController@ajaxAnswer');

  Route::get('/import-export', 'ImportexportController@index')->name('import-export.index');
  Route::any('/import-export/import', 'ImportexportController@import')->name('import-export.import');
  Route::any('/import-export/update', 'ImportexportController@update')->name('import-export.update');
  Route::any('/import-export/export', 'ImportexportController@export')->name('import-export.export');

  Route::match(['get', 'post'], 'parser', 'ParserController@index')->name('parser');
});


/*
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::post('/user/edit', 'UserController@userEdit')->name('user.edit');
Route::get('/user/orders', 'OrderController@usersOrders')->name('usersOrders')->middleware('auth');
Route::get('/user/order/{order}', 'OrderController@usersOrder')->name('usersOrder')->middleware('auth');
Auth::routes();
*/


Route::get('/{staticpage}', 'MainController@staticpage')->name('staticpage');
