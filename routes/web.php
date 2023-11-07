<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // $products = Product::all();
    $products = Product::with('feedbacks.comments')->get();
    // dd($products);
    return view('welcome', compact('products'));
});
Route::get('tiny', function(){
    return view('tiny');
});
// Route::get('/', [HomeController::class, 'index']);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    Route::resource('products', ProductController::class);

    Route::resource('feedbacks', FeedbackController::class);
    Route::post('/feedback/{feedback}/toggle-comments', [FeedbackController::class, 'toggleComments'])->name('feedback.toggle-comments');
    Route::post('/feedback/{feedback}/vote', [FeedbackController::class, 'vote'])->name('feedback.vote');
    Route::post('/feedback/{feedback}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::resource('categories', CategoryController::class);
});
