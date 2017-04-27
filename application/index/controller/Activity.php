<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/3/13
 * Time: 16:30
 */

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\admin\model\Activity as ActivityModel;
class Activity extends Controller
{
    public function index()
    {
        $activities = ActivityModel::where("status", 1)->order('start', 'desc')->paginate(9);
        $this->assign("activities", $activities);
        $page = $activities->render();
        $this->assign("page", $page);
        return $this->fetch();
    }

    public function view(Request $request)
    {
        $id = $request->param("id");
        if(!empty($id))
        {
          $activity = ActivityModel::get($id);
          if(!empty($activity) && $activity->status == 1)
          {
              $featuredActivities = ActivityModel::where("status", 1)->where('id', '<>', $id)->order('start','desc')->limit(5)->select();
              $this->assign("featuredActivities", $featuredActivities);

              $activity = ActivityModel::get($id);
              $this->assign("activity", $activity);
              return $this->fetch();
          }
        }
        $this->redirect("/index/activity/index");
    }

}