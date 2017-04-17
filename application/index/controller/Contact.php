<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/4/17
 * Time: 14:11
 */

namespace app\index\controller;
use think\Controller;
use think\Request;

class Contact extends Controller
{
    public function index(Request $request)
    {
        return $this->fetch();
    }
}