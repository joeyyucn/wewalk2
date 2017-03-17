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
        $activities = ActivityModel::all();
        $this->assign("activities", $activities);
        return $this->fetch();
    }

    public function view(Request $request)
    {
        $id = $request->param("id");
        $found = false;
        if(!empty($id))
        {
          $activity = ActivityModel::get($id);
          if(!empty($activity))
          {
              $this->assign("activity", $activity);
              return $this->fetch();
          }
        }

        $this->redirect("/index/activity/index");
    }

}