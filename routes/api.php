<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OpportuniteController;




Route::post('/contact', [ContactController::class, 'send'])->name('contact.store');
 Route::get('/messages', [ContactController::class, 'index'])->name('messages');
Route::delete('/messages/{id}', [ContactController::class, 'destroy'])->name('messages.destroy');


Route::get('/blog',[BlogController::class,'blog'])->name('blog.liste');
Route::get('/blog/detail/{id}',[BlogController::class,'show'])->name('blog.detail');

 Route::get('/commentaires/{blog_id}', [CommentaireController::class, 'index'])->name('commentaires.index');
  Route::post('/commentaires/{blog}', [CommentaireController::class, 'store'])->name('commentaires.store');


 Route::get('job-offers', [OpportuniteController::class, 'offres']);
  Route::get('job-offers/{id}', [OpportuniteController::class, 'show']);



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
//     // Blog + Commentaires
//     // Route::apiResource('blogs', BlogController::class);
//     Route::post('blogs/{blog}/comments', [CommentController::class, 'store']);

//     // Offres d'emploi
//     Route::get('job-offers', [JobOfferController::class, 'index']);
//     Route::get('job-offers/{id}', [JobOfferController::class, 'show']);
//     Route::post('job-offers/{id}/apply', [ApplicationController::class, 'store']);

//     // Admin (protégé par middleware admin)
//     Route::middleware('admin')->group(function () {
//         Route::post('job-offers', [JobOfferController::class, 'store']);
//         Route::put('job-offers/{jobOffer}', [JobOfferController::class, 'update']);
//         Route::delete('job-offers/{jobOffer}', [JobOfferController::class, 'destroy']);
//     });

//     // Contact
//     Route::post('contact', [ContactController::class, 'store']);
// });
