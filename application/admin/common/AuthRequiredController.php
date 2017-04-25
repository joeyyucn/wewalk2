<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 4/25/2017
 * Time: 10:41 AM
 */

namespace app\admin\common;
use think\Controller;
use app\admin\common\AuthUtil;
use think\response\Redirect;

class AuthRequiredController extends Controller
{
    protected $beforeActionList  = ['verifyLogin'];

    protected function verifyLogin()
    {
        if(!AuthUtil::isLogin())
        {
            if($this->request->isAjax())
            {
                return ["result"=>"-1", "未登录"];
            }
            else
            {
                redirect("/admin/auth/login");
                $response = new Redirect('/admin/auth/login');
                abort($response);
            }
        }
        else
        {
            $this->assign("loginUser", AuthUtil::username());
        }
    }
}