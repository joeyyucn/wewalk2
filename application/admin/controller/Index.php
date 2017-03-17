<?php
/**
 * Created by PhpStorm.
 * User: JYu2
 * Date: 3/8/2017
 * Time: 3:31 PM
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\SiteConfig;
class Index extends Controller
{
    public function index(Request $request)
    {
        if($request->isGet())
        {
            $config = SiteConfig::load();
            $this->assign("config", $config);
            return $this->fetch();
        }
    }
}