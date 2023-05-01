<?php
namespace App\Services;

use App\Helpers\Result;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Functions;
class AdminLoginService
{
    //错误信息
    public  $message = '';

    //用户信息
    public  $_user = [];

    //是否登录保存cookie
    public  $cookie = false;

    /**
     * 登录操作
     * @param array $data
     * @return JsonResponse
     */
    public function login($data): JsonResponse
    {
       //验证用户输入是否符合规则
        if (!$this->validate($data)) {
              return Result::error($this->message);
        }
        //验证user_code是否存在
        $user = $this->getUser('user_code', $data['user_id']);
        if (!$user) {
            return Result::error('	該当ユーザーが存在しません。');
        }
        //验证密码
        if(!$this->validatePassword($data['password'])){
            return Result::error($this->message);
        }
        //存储登录信息到session和cookie
        if (!$this->loginSession($user['id'])) {
            return Result::error($this->message);
        }


        return Result::success("登录成功");
    }


    /**
     * 保存登录信息
     * @param $id
     * @return bool
     */
    public function loginSession($id): bool
    {
        $user = $this->getUser('id', $id);
        if (!$user) {
            $this->message = '該当ユーザーが存在しません。';
            return false;
        }

        if ($user['is_youkou'] != 1) {
            $this->message = '用户已被禁用，无法登录';
            return false;
        }

        session()->flush();
        session()->put('user_code',$user['user_code']);
        Cookie::queue('user_code', $user['user_code'], 60 * 24 * 30); // 有效期为 30 天

        return true;
    }







    /**
     * 验证登录信息
     * @param $data
     * @return bool
     */
    public function validate($data): bool
    {

        // 验证规则
        $rules = [
            'user_id' => 'required|alpha_dash|min:8|max:20',
            'password' => 'required|min:6|max:15',
        ];

        // 错误信息
        $messages = [
            'user_id.required' => '请输入用户名',
            'user_id.alpha_dash' => '用户名必须为 8-20 个字符，且仅包含字母、数字、下划线和破折号',
            'user_id.min' => '用户名必须为 8-20 个字符',
            'user_id.max' => '用户名必须为 8-20 个字符',
            'password.required' => '请输入密码',
            'password.min' => '密码至少需要 8-15 个字符',
            'password.max' => '用户名必须为 6-15 个字符',
        ];

        $validator = Validator::make($data,$rules,$messages);
        if ($validator->stopOnFirstFailure()->fails()) {
            // 验证失败，返回错误信息
            $error = $validator->errors()->first();
            $this->message = $error ?: '提交数据错误';
            return false;
        }

        if (isset($data['remember']) && $data['remember']) {
            $this->cookie = true;
        }
        return true;
    }


    /**
     * 获取用户信息
     * @param string $field
     * @param string $value
     * @return array
     */
    public function getUser(string $field = '', $value = '')
    {


        if (!$this->_user) {
            if ($field && $value) {
                $user  = AdminUser::where($field,$value)->first();
                $this->_user = $user?Functions::stdToArray($user):[];
            }
        }
        return $this->_user;
    }

    /**
     * 验证密码
     * @param $password
     * @return bool
     */
    public function validatePassword($password):bool{
        if(!$this->_user){
            $this->message = '用户信息获取失败';
            return false;
        }

        if(strtolower($this->_user['password'])!=strtolower(md5($password))){
            $this->message = 'パスワードが間違っています。';
            return false;
        }
        return true;
    }


}
