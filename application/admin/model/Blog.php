<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/3/10
 * Time: 11:26
 */

namespace app\admin\model;
use think\Model;

class Blog extends Model
{
    public function getcreatetimeAttr($value)
    {
        return strtotime($value);
    }
}