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
            $publish = $request->param("publish");
            $id = $request->param("id");
            if(!empty($caption) && !empty($content) && !empty($id))
            {
                $beUpdate = $id != -1;
                $blog = new BlogModel();
                $blog->caption = $caption;
                $blog->content = $content;
                if($beUpdate)
                    $blog->id = $id;

                if($publish == "on")
                    $blog->status = 1;

                if(!empty($_FILES['cover']['name']))
                {
                    $blog->cover = upload_image("images/blog/", (string)time());
                }

                $blog->isUpdate($beUpdate)->save();


                return ["result"=>0, "id"=>$blog->getData("id")];
            }
            return ["result"=>-1, "error"=>"invalid request"];
        }
    }

    public function edit(Request $request)
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
            return "doesn't exist! STUPID";
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