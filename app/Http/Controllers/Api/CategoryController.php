<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    // 显示全部分类
    public function index(){
        return Category::orderBy('created_at','asc')->get();
    }
}
