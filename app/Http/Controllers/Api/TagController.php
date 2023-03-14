<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
class TagController extends Controller
{
    // 显示全部标签
    public function index(){
        return Tag::orderBy('created_at','asc')->get();
    }
}
