<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 4/21/2017
 * Time: 3:09 PM
 */

namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\model\Message as MessageModel;
use app\admin\common\AuthRequiredController;

class Message extends AuthRequiredController
{

    public function index()
    {
        $messages = MessageModel::order("id", "DESC")->paginate(20);
        $pages = $messages->render();
        $this->assign("messages", $messages);
        $this->assign("pages", $pages);
        return $this->fetch();
    }

    public function getmessage(Request $request)
    {
        if($request->isAjax() && $request->isGet())
        {
            $id = $request->param("id");
            if(!empty($id))
            {
                $message = MessageModel::get($id);
                $message->flag = 1;
                $message->isUpdate(true)->save();
                return ['result'=>0,
                    'sender'=>$message->sender,
                    'email'=>$message->email,
                    'message'=>$message->message
                ];
            }
            else{
                return ['result'=>-1, 'message'=>'消息不存在'];
            }
        }
        return ['result'=>-1, 'message'=>'无效的请求'];
    }

    public function deletemessage(Request $request)
    {
        if($request->isAjax() && $request->isPost())
        {
            $id = $request->param("id");
            if(!empty($id))
            {
                $message = MessageModel::get($id);
                $message->delete();
                return ['result'=>0,
                    'sender'=>$message->sender,
                    'email'=>$message->email,
                    'message'=>$message->message
                ];
            }
            return ['result'=>0, message=>"success"];
        }
        return ['result'=>-1, 'message'=>'无效的请求'];
    }

}