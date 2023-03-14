<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
    use HasFactory;
//    use SoftDeletes,HasApiTokens;
    protected $table = 'users';
    protected $fillable = ['username','password'];

    protected $hidden = [
        'password'
//        'created_at',
//        'updated_at'
    ];

    //    转换字段类型
    protected $casts = [
        'created_at'=>'date:Y-m-d H:i:s',
        'updated_at'=>'date:Y-m-d H:i:s'
    ];
    //    remember 的默认使用
    //    protected $rememberTokenName = false;

    /**
     * 因为一个用户有很多文章，所以用户和文章是一对多的关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(){
        return $this->hasMany(Article::class);
    }
}
