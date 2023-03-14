<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//    指定使用 categorys 数据表
    protected $table = 'categorys';

    use HasFactory;

    protected $casts = [
        'created_at'=>'date:Y-m-d H:i:s',
        'updated_at'=>'date:Y-m-d H:i:s'
    ];
}
