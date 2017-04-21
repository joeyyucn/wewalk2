<?php
/**
 * Created by PhpStorm.
 * User: JYu2
 * Date: 3/8/2017
 * Time: 3:31 PM
 */

namespace app\admin\controller;

use think\Controller;
use think\exception\HttpException;
use think\Request;
use app\admin\model\SiteConfig;
class Index extends Controller
{
    public function index(Request $request)
    {
        if($request->isGet())
        {
            $config = SiteConfig::load();
            $this->assign("config", $config);
            return $this->fetch();
        }
        else if($request->isPost() && $request->isAjax()) {
            $config = SiteConfig::load();
            if (!empty($_FILES["image1"]["name"])) {
                $config->home_carousel_img1 = upload_image("images/config/", "home_carousel_img1", "image1");
            }

            if (!empty($_FILES["image2"]["name"])) {
                $config->home_carousel_img2 = upload_image("images/config/", "home_carousel_img2", "image2");
            }

            if (!empty($_FILES["image3"]["name"])) {
                $config->home_carousel_img3 = upload_image("images/config/", "home_carousel_img3", "image3");
            }

            $link1 = $request->param("link1");
            $link2 = $request->param("link2");
            $link3 = $request->param("link3");

            if(isset($link1))
            {
                $link1 = trim($link1);
                $link1 = strlen($link1) == 0 ? "#" : $link1;
                $config->home_carousel_link1 = $link1;
            }

            if(isset($link2))
            {
                $link2 = trim($link2);
                $link2 = strlen($link3) == 0 ? "#" : $link2;
                $config->home_carousel_link2= $link2;
            }

            if(isset($link3))
            {
                $link3 = trim($link3);
                $link3 = strlen($link3) == 0 ? "#" : $link3;
                $config->home_carousel_link3 = $link3;
            }

            $config->save();
            return ["result"=>0, "value"=>$config->toArray()];
        }

    }


    public function uploadImage(Request $request)
    {
        $file = $request->file('file');
        if($file)
        {
            $info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'images'.DS.'uploads');
            if($info){
                echo json_encode(["location" => "/images/uploads/".$info->getSaveName()]);
            }else{
                throw new HttpException(500, $file->getError());
            }
        }
        else
        {
            throw new \think\Exception("文件不能为空");
        }


    }
}