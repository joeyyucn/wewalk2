<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/3/10
 * Time: 14:07
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Activity as ActivityModel;
class Activity extends  Controller
{
    public function  _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        // check login status
    }

    public function index()
    {
        $activities = ActivityModel::all();
        $this->assign("activities", $activities);
        return $this->fetch();
    }

    public function create(Request $request)
    {
        if($request->isGet())
        {
            return $this->fetch();
        }
        elseif($request->isPost())
        {
            $caption  = $request->param("caption");
            $location  = $request->param("location");
            $start_time = $request->param("datestart");
            $end_time = $request->param("dateend");
            $price = $request->param("price");
            $content = $request->param("content");
            if(!empty($start_time))
                $start_time = date_create_from_format('Y-m-d H:i:s', $start_time);

            if(!empty($end_time))
                $end_time = date_create_from_format('Y-m-d H:i:s', $end_time);

            if(!empty($caption) and !empty($location) and !empty($start_time)
                and !empty($end_time) and !empty($price) and !empty($content))
            {
                $activity = new ActivityModel();
                $activity->caption = $caption;
                $activity->location = $location;
                $activity->start = $start_time->format("Y-m-d H:i:s");
                $activity->end = $end_time->format("Y-m-d H:i:s");
                $activity->price = $price;
                $activity->content = $content;
                $activity->save();
                echo "保存成功";
            }
        }

    }

    public function edit(Request $request)
    {
        if($request->isGet())
        {
            $id = $request->param("id");
            if(!empty($id))
            {
                $activity = ActivityModel::get($id);
                if($activity)
                {
                    $this->assign("activity", $activity);
                    return $this->fetch();

                }
            }
        }
    }

    public function  view(Request $request)
    {
        if($request->isGet())
        {
            $id = $request->param("id");
            if(!empty($id))
            {
                $activity = ActivityModel::get($id);
                if($activity)
                {
                    $this->assign("activity", $activity);
                    return $this->fetch();

                }
            }
        }
    }
}