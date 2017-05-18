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
    public function index(Request $request)
    {
        $type = $request->param('type');
        if(!isset($type))
        {
            $type = 4;
        }

            switch ($type)
            {
                case 0:
                    $activities = ActivityModel::where("status", 1)->where('type', 0)->order('start', 'desc')->paginate(9);
                    break;
                case 1:
                    $activities = ActivityModel::where("status", 1)->where('type', 1)->order('start', 'desc')->paginate(9);
                    break;
                case 2:
                    $activities = ActivityModel::where("status", 1)->where('type', 2)->order('start', 'desc')->paginate(9);
                    break;
                case 3:
                    $activities = ActivityModel::where("status", 1)->where('type','<>', 0)->order('start', 'desc')->paginate(9);
                    break;
                default:
                    $activities = ActivityModel::where("status", 1)->order('start', 'desc')->paginate(9);
                    break;
            }
        $this->assign("type", $type);
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