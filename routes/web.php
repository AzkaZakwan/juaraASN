<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\QuestionBankController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\ArticleController;
use App\Models\Article;

Route::get('/', function () {

    $articles = Article::where('is_published', true)
        ->latest()        
        ->get();

    return view('landing', compact('articles'));


})->name('landing');

Route::post('/midtrans/callback', [PaymentController::class, 'callback'])
    ->name('midtrans.callback');

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/tryout', [TryoutController::class, 'index'])->name('tryout');
    
    Route::get('/riwayat', [TryoutController::class, 'history'])->name('riwayat');

    Route::get('/materi', function () {
        return view('materi');
    })->name('materi');

    // Route::get('/tryout/starts', function () {
    //     return view('tryout.starts');
    // })->name('starts');
    Route::get('/tryout/session/{attempt}', [TryoutController::class, 'starts'])
    ->name('starts');

    Route::post('/tryout/{package}/starts', [TryoutController::class, 'start'])
    ->name('tryout.start');

    Route::get('/tryout/{package}/prepare', [TryoutController::class, 'prepare'])
    ->name('prepare');

    Route::post('/tryout/save-answer', [TryoutController::class, 'saveAnswer'])
    ->name('tryout.saveAnswer');

    Route::post('/tryout/{attempt}/submit', [TryoutController::class, 'submit'])
    ->name('tryout.submit');

    Route::get('/tryout/{attempt}/result', [TryoutController::class, 'result'])
    ->name('tryout.result');

    Route::get('/tryout/{attempt}/review', [TryoutController::class, 'review'])
    ->name('tryout.review');
    
    // Route::get('/tryout/{package}/ranking', [TryoutController::class, 'ranking'])
    // ->name('tryout.ranking');

    Route::post('/tryout/{attempt}/cancel', [TryoutController::class, 'cancel'])
    ->name('tryout.cancel');

    Route::get('/tryout/{package}/buy', [TryoutController::class, 'buy'])
    ->name('tryout.buy');

    Route::post('/payment/{package}/checkout', [PaymentController::class, 'checkout'])
    ->name('payment.checkout');

    Route::get('/payment/{transaction}/success', [PaymentController::class, 'success'])
    ->name('payment.success');    
});

Route::get('/artikel', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('/artikel/{article:slug}', [ArticleController::class, 'show'])
        ->name('articles.show');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [PackageController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    Route::resource('packages', PackageController::class);

    Route::get('packages/template/download', [PackageController::class, 'downloadTemplate'])
        ->name('packages.template.download');

    Route::resource('questions', QuestionBankController::class);
    
    Route::get('packages/{package}/questions', [PackageController::class, 'questions'])
        ->name('packages.questions');
    
    Route::post('packages/{package}/questions', [PackageController::class, 'storeQuestions'])
        ->name('packages.questions.store');

    Route::get('/admin/tryout', function () {
        return view('admin.magtryout');
    })->name('admintryout');

    Route::resource('articles', AdminArticleController::class)
    ->names('admin.articles');
    
});

require __DIR__.'/auth.php';

