<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/3/15
 * Time: 12:09
 */

namespace app\index\controller;

use think\Controller;
class Blog extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

}