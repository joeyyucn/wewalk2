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
class Blog extends Controller
{
    public function index()
    {
        $blogs =BlogModel::all();
        $this->assign("blogs", $blogs);
        return $this->fetch();
    }

    public function view(Request $request)
    {
        $id = $request->param("id");
        if(!empty($id))
        {
            $blog = BlogModel::get($id);
            if(!empty($blog))
            {
                $this->assign("blog", $blog);
                return $this->fetch();
            }
        }

        $this->redirect("/index/blog/index");
    }

}