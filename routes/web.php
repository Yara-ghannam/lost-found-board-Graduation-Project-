<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('home');
})->name('home');



//items grouped routes
Route::get('/found-item', FoundItemController::class . '@indexItems')->name('found-items');
Route::get('/lost-item', LostItemController::class . '@indexItems')->name('lost-items');


//Authintacation
Route::get('/register', AuthController::class . '@showRegisterFrom')->name('register');
Route::post('/create-register', AuthController::class . '@creatRegister')->name('create-register');
Route::get('/show-login', AuthController::class . '@showLoginFrom')->name('show-login');
Route::post('/login', AuthController::class . '@login')->name('login');
Route::get('/forgot-password', AuthController::class . '@showForgotPasswordForm')->name('forgot-password');


Route::get('/testtoshowuserdata', AuthController::class . '@testtoshowuserdata');
Route::post('/logout', AuthController::class . '@logout')->name('logout');
Route::get('/my-posts', LostItemController::class . '@myPosts')->name('my-posts')->middleware('auth.check');



Route::middleware(['auth.check'])->group(function () {
    Route::get('/report-found', FoundItemController::class . '@reportFound')->name('report-found');
    Route::post('/store-report-found', FoundItemController::class . '@storeReportFound')->name('store-report-found');
    Route::get('/report-lost', LostItemController::class . '@reportLost')->name('report-lost');
    Route::post('/store-report-lost', LostItemController::class . '@storeReportLost')->name('store-report-lost');




    //items grouped routes
    Route::get('/found-item', FoundItemController::class . '@indexItems')->name('found-items');
    Route::get('/lost-item', LostItemController::class . '@indexItems')->name('lost-items');

    // Posts routes
    Route::get('/posts', PostController::class . '@index')->name('posts.index');
    Route::delete('/delete-post/{id}', PostController::class . '@DeletePost')->name('posts.delete');
    Route::get('/edit-post/{id?}', PostController::class . '@editPost')->name('posts.edit');
    Route::post('/update-post/{id}', PostController::class . '@updatePost')->name('posts.update');

    Route::post('/claim/store', ClaimController::class . '@store')->name('claim.store');
    Route::get('/claim/owner-info', ClaimController::class . '@showOwnerInfo')->name('claim.owner-info');

    //Comments
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    //dashboard
    Route::get('/dashboard', AdminController::class . '@index')->name('dashboard')->middleware('check.role');
    Route::get('/users', AdminController::class . '@showUsers')->name('users')->middleware('check.role');
    Route::patch('/posts/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('posts.toggleStatus');
    //claims
    Route::get('/post/claims', [AdminController::class, 'postClaims'])->name('posts.claims');
    Route::get('/claims', AdminController::class . '@claims')->name('claims');
    Route::put('/claims/{claimId}/approve/{userId}', [AdminController::class, 'approve'])->name('admin.claims.approve');
    Route::put('/claims/{claimId}/reject/{userId}', [AdminController::class, 'reject'])->name('admin.claims.reject');

    Route::get('/users-delete/{id}', AdminController::class . '@deleteUser')->name('users.delete');
    Route::get('/your-profile', UserController::class . '@index')->name('your.profile');
    Route::put('/store-edit-profile', UserController::class . '@StoreEditProfile')->name('store.edit.profile');
    Route::get('/reset-password', AuthController::class . '@showResetPasswordForm')->name('reset-password');
    Route::post('/update-password', AuthController::class . '@resetPassword')->name('password.update');

    // to close notification alerts
    Route::post('/notifications/{id}/read', function ($id) {
        $notification = \App\Models\Notification::where('id', $id)
            ->where('user_id', Session::get('user_id'))
            ->firstOrFail();

        $notification->update([
            'is_read' => 1
        ]);

        return response()->json(['success' => true]);
    });

});
