<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 前缀 v1
Route::group(['prefix'=>'/v1'],function (){
    // 用户登录
    Route::post('/login',[\App\Http\Controllers\Api\UserController::class,'login'])->name('users.login');
    // 用户登出
    Route::post('/logout',[\App\Http\Controllers\Api\UserController::class,'logout'])->name('users.logout');

    // 显示所有用户
    Route::get('/user', [\App\Http\Controllers\Api\UserController::class,'index'])->name('users.index');
    // 显示指定用户
    Route::get('/user/{username}',[\App\Http\Controllers\Api\UserController::class,'show'])->name('users.show');
    // 用户注册
    Route::post('/store',[\App\Http\Controllers\Api\UserController::class,'store'])->name('users.store');

    // 文章
    Route::get('/article', [\App\Http\Controllers\Api\ArticleController::class,'index'])->name('articles.index');
    //  根据分类名获取文章
    Route::get('/article/{category_name}', [\App\Http\Controllers\Api\ArticleController::class,'show'])->name('articles.show');
    //  根据文章id获取文章的详情信息
    Route::get('/article/{category_name}/{article_id}', [\App\Http\Controllers\Api\ArticleController::class,'showArticle'])->name('articles.showArticle');

    // 标签
    Route::get('/tag', [\App\Http\Controllers\Api\TagController::class,'index'])->name('tags.index');
    // 分类
    Route::get('/category', [\App\Http\Controllers\Api\CategoryController::class,'index'])->name('categorys.index');

    // 只有登录才能访问
    Route::group(['middleware'=>'auth'],function (){

    });
});
