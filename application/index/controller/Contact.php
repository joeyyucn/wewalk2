<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/4/17
 * Time: 14:11
 */

namespace app\index\controller;
use think\Controller;
use think\exception\HttpException;
use think\image\Exception;
use think\Request;
use app\admin\model\Message as MessageModel;

class Contact extends Controller
{
    public function index(Request $request)
    {
        return $this->fetch();
    }

    public function message(Request $request)
    {
        if($request->isAjax()) {
            $sender = $request->param("name");
            $email = $request->param('email');
            $data = $request->param('message');
            $captcha = $request->param('captcha');
            if (!captcha_check($captcha)) {
                return ['result' => -2, 'message' => '验证码错误'];
            }

            if (!empty($sender) && !empty($email) && !empty($data))
            {
                $message = new MessageModel();
                $message->sender = $sender;
                $message->email = $email;
                $message->message = $data;
                try
                {
                    $message->save();
                }
                catch (Exception $exception)
                {
                    return ['result'=>0,'message'=>"已发送"];
                }
                return ['result'=>0,'message'=>"已发送"];
            }
            else
            {
                return ['result'=>-2, 'message' =>'信息不完整‘'];
            }
            return ['result'=>-3, 'message' =>'无效的请求‘'];
        }
        else
        {
            throw new HttpException(404, "INVALID REQUEST");
        }
    }
}