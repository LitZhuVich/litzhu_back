<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
//    指定数据表
    protected $table = 'articles';

//    public function articleCategory(){
//        return $this->belongsToMany(ArticleCategory::class);
//    }
//    protected $hidden = ['created_at','updated_at'];

    protected $casts = [
        'created_at'=>'date:Y-m-d H:i:s',
        'updated_at'=>'date:Y-m-d H:i:s'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
