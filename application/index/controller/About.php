<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 4/25/2017
 * Time: 12:38 PM
 */

namespace app\index\controller;
use think\Controller;

class About extends Controller
{

    public function index()
    {
        return $this->fetch();
    }
}