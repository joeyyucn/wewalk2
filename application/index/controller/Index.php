<?php
namespace app\index\controller;

use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function base()
    {
        return $this->fetch('D:\git\wewalk2\application\index\view\public\base.html');
    }
}
