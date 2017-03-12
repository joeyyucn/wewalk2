<?php
/**
 * Created by PhpStorm.
 * User: jyu
 * Date: 2017/3/11
 * Time: 10:39
 */

namespace app\admin\controller;

use think\Controller;
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
}