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

class AuthUtil
{
    private static $auth_session_key = "login_user";
    public static function isLogin()
    {
        return !empty(Session::get(AuthUtil::$auth_session_key));
    }

    public static function login($name, $pwd)
    {
        $user = Admin::get(['username'=>$name, 'password'=>md5($pwd)]);
        if(!$user)
            return false;
        Session::set(AuthUtil::$auth_session_key, $user);
        return true;
    }

    public static function logout()
    {
        Session::delete(AuthUtil::$auth_session_key);
    }

    public static function id()
    {
        $loginUser = self::getLoginUser();
        if(!$loginUser)
            throw new Exception("用户未登陆");
        return $loginUser->id;
    }

    public static function username()
    {
        $loginUser = self::getLoginUser();
        if(!$loginUser)
            throw new Exception("用户未登陆");
        return $loginUser->username;
    }

    public static function verify($name, $pwd)
    {
        $user = Admin::get(['username' => $name, 'password' => md5($pwd)]);
        if (!$user)
            return false;
        return true;
    }

    private static function getLoginUser()
    {
        return Session::get(AuthUtil::$auth_session_key);
    }
}