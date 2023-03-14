<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()){
            case "GET":
            {
                return [
                    'id'        =>  ['required,exists:shop_user,id']
                ];
            }
            case "POST":{
                return [
                    'name'      =>  ['required','max:12','unique:users,name'],
                    'password'  =>  ['required']
                ];
            }
            case "PUT":
            case "PATHCH":
            case "DELETE":
            default:{
                return [];
            }
        }
    }
    public function messages(){
        return [
            'id.required'   =>  '用户ID必须填写',
            'id.exists'     =>  '用户不存在',
            'username.unique'   =>  '用户名已经存在',
            'username.required' =>  '用户名不能为空',
            'username.max'      =>  '用户名最大长度为12个字符',
            'password.required' =>  '密码不能为空'
        ];
    }
}
