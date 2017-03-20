<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\SiteConfig;
use app\admin\model\Activity as ActivityModel;
use app\admin\model\Blog as BlogModel;

class Index extends Controller
{
    public function index()
    {
        // load website config
        $config = SiteConfig::load();
        $this->assign("config", $config);

        // set featured activity
        $featuredActivity = ActivityModel::all( function($query){
            $query->where("status", 1)->limit(3)->order('start', 'datetime');
        });
        $this->assign("featuredactivity", $featuredActivity);

        $featuredBlog = BlogModel::all( function($query){
            $query->where("status", 1)->limit(3)->order("createtime", 'datetime');
        });
        $this->assign("featuredBlog", $featuredBlog);

        return $this->fetch();
    }

    public function base()
    {
        return $this->fetch('public:base');
    }
}
