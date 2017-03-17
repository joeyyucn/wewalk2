<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/3/10
 * Time: 14:59
 */

namespace app\admin\model;

use think\Model;
class Activity extends Model
{
    public function getStartAttr($value)
    {
        return strtotime($value);
    }

    public function getEndAttr($value)
    {
        return strtotime($value);
    }
}