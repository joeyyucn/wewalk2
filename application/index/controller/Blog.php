<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/3/15
 * Time: 12:09
 */

namespace app\index\controller;

use think\Controller;
use app\admin\model\Blog as BlogModel;
use think\Request;
use app\admin\model\Activity as ActivityModel;
class Blog extends Controller
{
    public function index()
    {
        $featuredblogs =BlogModel::all( function($query){
            $query->where("status", 1)->where("stick_top", true)->order("lastupdate", 'desc');
        });
        $this->assign("featuredblogs", $featuredblogs);

        $blogs = BlogModel::where("stick_top", false)->where("status", 1)->order("lastupdate", 'desc')->paginate(20);
        $this->assign("blogs", $blogs);
        $this->assign("page", $blogs->render());

        $featuredActivities = ActivityModel::where("status", 1)->order('start','desc')->limit(5)->select();
        $this->assign("featuredActivities", $featuredActivities);
        return $this->fetch();
    }

    public function view(Request $request)
    {
        $id = $request->param("id");
        if(!empty($id))
        {
            $blog = BlogModel::get($id);
            if(!empty($blog) && $blog->status==1)
            {
                $this->assign("blog", $blog);

                $featuredActivities = ActivityModel::where("status", 1)->order('start','desc')->limit(5)->select();
                $this->assign("featuredActivities", $featuredActivities);
                return $this->fetch();
            }
        }

        $this->redirect("/index/blog/index");
    }

}