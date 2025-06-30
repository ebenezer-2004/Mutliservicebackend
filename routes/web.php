<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
 use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\OpportuniteController;
use App\Http\Controllers\AdminController;


// Route::get('/', function () {
//     return view('admin.candidature._index');
// });
Route::get('/login',[AdminController::class, 'login'])->name('login');
Route::post('/authentification',[AdminController::class, 'dologin'])->name('dologin');
Route::delete('/logout',[AdminController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function(){
 Route::get('/',[AdminController::class, "index"])->name('dashboard');



// Route Blog
Route::prefix('admin')->name('admin.')->group(function(){
Route::get('/blog',[BlogController::class,'index'])->name('blog');
Route::post('/blog',[BlogController::class,'store'])->name('blog.store');
Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blog.update');
Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
Route::get('/blogs/{id}/comments', [BlogController::class, 'comments']);
 Route::delete('/comments/{id}', [BlogController::class, 'destroycomments']);
Route::put('blogs/{id}/publier', [BlogController::class, 'publier'])->name('blogs.publier');
 //Route Blog


 // Route Offres

Route::get('/offres',[OpportuniteController::class,'index'])->name('offres');
Route::post('/offre/store',[OpportuniteController::class,'store'])->name('offre.store');
Route::delete('/offres/delete/{opportunite}', [OpportuniteController::class, 'destroy'])->name('offre.destroy');
Route::put('/offres/update/{opportunite}', [OpportuniteController::class, 'update'])->name('offre.update');
 //Route Offres

 //Routes Contact 

Route::get('/messages', [ContactController::class, 'index'])->name('messages');
Route::delete('/messages/{id}', [ContactController::class, 'destroy'])->name('messages.destroy');
Route::get('/commentaires/{blog_id}', [CommentaireController::class, 'index'])->name('commentaires.index');

 //Routes Contact







});
});