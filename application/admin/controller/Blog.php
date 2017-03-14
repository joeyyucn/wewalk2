<?php
/**
 * Created by PhpStorm.
 * User: JYu2
 * Date: 3/8/2017
 * Time: 3:46 PM
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Blog as BlogModel;
class Blog extends Controller
{
    public function index()
    {
        $this->assign('blogs', BlogModel::all());
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
            $caption = $request->param("caption");
            $content = $request->param("content");

            $blog = new BlogModel();
            $blog->caption = $caption;
            $blog->content = $content;

            $blog->save();
            return $content;
        }
    }

    public function edit(Request $request)
    {
        if($request->isGet())
        {
            $blog_id = $request->param("id");
            if(!empty($blog_id))
            {
                $blog = BlogModel::get($blog_id);
                if(!empty($blog))
                {
                    $this->assign("blog", $blog);
                    return $this->fetch();
                }
            }
        }
        else if($request->isPost())
        {
            $id = $request->param("id");
            $caption = $request->param("caption");
            $content = $request->param("content");
            $blog = BlogModel::get($id);
            if(!empty($blog))
            {
                $blog->content = $content;
                $blog->caption = $caption;
                $blog->save();
            }
        }
    }

    public function view(Request $request)
    {
        if($request->isGet())
        {
            $id = $request->param("id");
            $blog = BlogModel::get($id);
            if(!empty($blog))
            {
                $this->assign("blog", $blog);
                return $this->fetch();
            }
        }
    }

    public function uploadImage(Request $request)
    {
        $path = upload_image("images/blog/", (string)time());
        echo json_encode(["location" => "/$path"]);
    }
}