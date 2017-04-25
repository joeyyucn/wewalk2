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
use app\admin\common\AuthRequiredController;
class Blog extends AuthRequiredController
{
    public function index()
    {
        $blogs = BlogModel::order("id", "DESC")->paginate(15);
        $pages = $blogs->render();
        $this->assign('blogs', $blogs);
        $this->assign('pages', $pages);
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

                $file = $request->file('cover');
                if($file)
                {
                    $info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'images'.DS.'uploads');
                    if($info){
                        $blog->cover = "/images/uploads/".$info->getSaveName();
                    }else{
                        throw new HttpException(500, $file->getError());
                    }
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
            return "文章不存在";
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

    public function deleteBlog(Request $request)
    {
        if($request->isAjax() && $request->isPost())
        {
            $id = $request->param("id");
            if(!empty($id))
            {
                $blog = BlogModel::get($id);
                if($blog)
                {
                   $blog->delete();
                }
                return ['result'=>0, 'message'=>'删除成功'];
            }
        }
        return ["result"=>-1, "message"=>"无效的请求"];
    }

}