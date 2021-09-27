<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FeedBackController as AdminFeedBackController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Account\IndexController as AccountController;
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
Route::get('/', function () {
    return view('welcome');
});
*/
//auth
Route::group(['middleware' => 'auth'], function() {
	Route::get('/account', AccountController::class)
		->name('account');
	Route::get('/logout', function() {
		\Auth::logout();
		return redirect()->route('login');
	})->name('logout');

	//admin
	Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function() {
		Route::get('/', AdminController::class)
			->name('index');
		Route::resource('categories', AdminCategoryController::class);
		Route::resource('news', AdminNewsController::class);
		Route::resource('feedback', AdminFeedBackController::class);
		Route::resource('user', AdminUserController::class);
		Route::get('/parser', ParserController::class)
			->name('parser');
	});
});

//news
Route::get('/', [CategoryController::class, 'index'])
	->name('/');
Route::get('/category_{idCategory}/news', [NewsController::class, 'index'])
    ->where('idCategory', '\d+')
	->name('news');
Route::get('/category_{idCategory}/news/{id}', [NewsController::class, 'show'])
    ->where('idCategory', '\d+')
	->where('id', '\d+')
	->name('news.show');
Route::get('/welcome/{name}', function (string $name) {
    return "Hello {$name}";
});

Route::get('/welcome', function () {
    return "Hello NONAME";
});

Route::get('/about', function () {
    return "Внимание, это тестовый проект. И да, тут могла быть куча информации о нем...";
});

Route::get('/collections', function() {
	$collect = collect([1,3,6,7,2,8,9,3,23,68,11,6]);

	dump($collect->shuffle()->map(fn($item) => $item + 2)->toJson());
});

Route::get('/session', function () {
    if(!session()->has('demo')) {
		session(['demo' => 1]);  //->put('demo', 1);
	}

	dump(session()->all());
	session()->remove('demo');

	dump(session()->all());

	//return redirect()->route('admin.news.index')->withCookie(['one' => 'one']);
});

Route::group(['middleware' => 'guest'], function() {
	Route::get('/start/{driver}', [SocialController::class, 'start'])
		->name('start');
	Route::get('/callback/{driver}', [SocialController::class, 'callback'])
		->name('callback');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');