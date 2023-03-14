<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * 显示全部用户信息
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(){
        return User::all();
    }

    /**
     * 显示指定用户信息
     *
     * @param $username
     * @return mixed
     */
    public function show($username){
        $user = User::where('username',$username)->with('articles')->first();
        if (!$user){
            return response()->json(['message'=>'用户不存在'],404);
        }
        return $user;
    }

    /**
     * 用户注册
     *
     * @param UserRequest $request
     * @return string
     */
    public function store(Request $request){
        //^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$ 邮箱正则
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:30',
            'password' => 'required|max:30',
        ]);
        // 给定的数据未通过验证
        if ($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        // 获得通过验证的数据
        $validated = $validator->validated();
//        将获取到的密码哈希加密并返回
        $validated['password'] = Hash::make($validated['password']);
        // 保存数据
        $user = new User($validated);
        $user->save();
        return $user;
    }

    /**
     * 用户登录
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $user = User::where('username',$request->username)->first();
        if (!$user){
            return response()->json(['message'=>'用户名或密码错误'],401);
        }
        // 验证 用户密码
        if (Hash::check($request->password,$user->password)){
            Auth::loginUsingId($user->id,true);
            $user->login_token = md5($user->username);
            $user->save();
            return Auth::user();
//            return redirect()->back();
        }else{
            return response()->json(['message'=>'用户名或密码错误'],401);
        }
    }

    /**
     * 用户 登出
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request){
        $user = User::where('login_token',$request->token)->first();
        if (!$user){
            return response()->json(['message'=>'用户尚未登录'],401);
        }
        $user->login_token = null;
        $user->save();
        Auth::logout();
        return response()->json(['message'=>'登出成功']);
    }
}
