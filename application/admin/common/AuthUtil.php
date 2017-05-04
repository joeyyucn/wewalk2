<?php

/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 4/24/2017
 * Time: 5:26 PM
 */
namespace app\admin\common;
use think\image\Exception;
use think\Session;
use think\Cookie;
use think\Config;

class AuthUtil
{
    private static $auth_session_key = "login_user";
    private static $auth_last_active_key = "last_active";
    public static function isLogin($refreshSession=true)
    {
        if(!empty(AuthUtil::getLoginUser()))
        {
            if($refreshSession)
                Session::set(AuthUtil::$auth_last_active_key, time());
            return true;
        }
        return false;
    }

    public static function login($name, $pwd)
    {
        $user = Admin::get(['username'=>$name, 'password'=>md5($pwd)]);
        if(!$user)
            return false;
        Session::set(AuthUtil::$auth_session_key, $user);
        Session::set(AuthUtil::$auth_last_active_key, time());
        return true;
    }

    public static function logout()
    {
        Session::delete(AuthUtil::$auth_session_key);
        Session::delete(AuthUtil::$auth_last_active_key);
    }

    public static function id()
    {
        $loginUser = self::getLoginUser();
        if(!$loginUser)
            throw new Exception("用户未登陆或登录过期");
        return $loginUser->id;
    }

    public static function username()
    {
        $loginUser = self::getLoginUser();
        if(!$loginUser)
            throw new Exception("用户未登陆或登录过期");
        return $loginUser->username;
    }

    public static function verify($name, $pwd)
    {
        $user = Admin::get(['username' => $name, 'password' => md5($pwd)]);
        if (!$user)
            return false;
        return true;
    }

    public static function getLoginUser()
    {
        if(!AuthUtil::isSessionTimeout())
            return Session::get(AuthUtil::$auth_session_key);
        return null;
    }

    private static function isSessionTimeout()
    {
        $lastActive = Session::get(AuthUtil::$auth_last_active_key);
        if(!empty($lastActive))
        {
            $now = time();
            if($now < ($lastActive + Config::get('auth')['timeout']))
            {
                return false;
            }
        }
        return true;
    }

    public static function resetPassword($name, $password)
    {
        $user = Admin::get(['username' => $name]);
        if(empty($user))
            throw new Exception("用户不存在");
        $user->password = md5($password);
        $user->isUpdate(true)->save();
    }
}