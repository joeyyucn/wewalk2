<?php
/**
 * Created by PhpStorm.
 * User: JYu2
 * Date: 3/8/2017
 * Time: 3:31 PM
 */

namespace app\admin\controller;

use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}