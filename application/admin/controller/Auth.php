<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 4/24/2017
 * Time: 5:58 PM
 */

namespace app\admin\controller;
use app\admin\common\AuthUtil;
use think\Controller;
use think\Request;

class Auth extends Controller
{
    public function index(Request $request)
    {
        if(AuthUtil::isLogin())
        {
            return $this->redirect("/admin/");
        }

        return $this->redirect('/admin/auth/login');

    }

    public function login(Request $request)
    {
        if($request->isPost() && $request->isAjax())
        {
            if(!AuthUtil::isLogin())
            {
                $user = $request->param("username");
                $password = $request->param("password");
                $captcha = $request->param("captcha");
                if (!captcha_check($captcha)) {
                    return ['result' => -2, 'message' => '验证码错误'];
                }

                if(!empty($user) && !empty($password))
                {
                    if(AuthUtil::login($user, $password))
                    {
                        return ['result'=>0,'message'=>'登陆成功'];
                    }
                }
                return ['result'=>-1, 'message'=>'密码或用户名错误'];
            }
            else
            {
                return ['result'=>-3, 'message'=>'已登录'];
            }

        }
        else
        {
            if(!AuthUtil::isLogin())
                return $this->fetch();
            else
                return $this->redirect("/admin/");
        }
    }

    public function logout()
    {
        if(AuthUtil::isLogin())
        {
            AuthUtil::logout();
        }
        return $this->redirect("/admin/auth/login");
    }
}