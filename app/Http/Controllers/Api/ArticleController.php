<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ArticleCategory;

class ArticleController extends Controller
{
    /**
     * 显示全部文章
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(){
        return Article::orderBy('created_at','desc')->get();
    }

    /**
     * 根据分类的id来获取对应的文章和分类名
     *
     * @param $category_id
     * @return array
     */
    public function show($category_name){
        $article = Article::whereIn('id',ArticleCategory::whereIn('category_id',Category::where('name',$category_name)->pluck('id'))->pluck('article_id'))
            ->orderBy('created_at','desc')->get();
        $category = Category::where('name',$category_name)->get();
        if (!$category || !$article){
            return response()->json(['message'=>'该分类不存在'],404);
        }
        return ["category"=>$category,"article"=>$article];
    }

    /**
     * 根据文章id获取文章的详情信息
     *
     * @param $category_id
     * @param $article_id
     * @return \Illuminate\Http\JsonResponse|mixed|void
     */
    public function showArticle($category_name,$article_id){
        $articles = Article::whereIn('id',ArticleCategory::whereIn('category_id',Category::where('name',$category_name)->pluck('id'))->pluck('article_id'))
            ->orderBy('created_at','desc')->with('user')->get();
        foreach ($articles as $article){
            if ($article_id == $article->id){
                return ['article'=>$article];
            }
        }

        return response()->json(['message'=>'该文章不存在'],404);
    }
}
