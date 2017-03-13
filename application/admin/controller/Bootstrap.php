<?php
/**
 * Created by PhpStorm.
 * User: jyu
 * Date: 2017/3/11
 * Time: 10:39
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;
class Bootstrap extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function base()
    {
        return $this->fetch("public:base");
    }

    public function ajax(Request $request)
    {
        if($request->isGet())
        {
            return $this->fetch();
        }
        elseif($request->isAjax())
        {
            //header("Content-Type:application/json; charset=utf-8");
            return ['result'=>0, 'message'=>'hello this is an ajax handler'];
        }
    }
}