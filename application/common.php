<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * @param $path : file path where stores the upload file
 * @param $name :  new file path
 * @param $index : index in $_FILES if exists otherwise null
 * @return string : full file path
 * @throws Exception
 */
function upload_image($path, $name, $index=null)
{
    if(empty($index))
    {
        reset($_FILES);
        $temp = current($_FILES);
    }
    else
    {
        $temp = $_FILES[$index];
    }


    // check origin
    if(is_uploaded_file($temp['tmp_name']))
    {

    }

    if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name']))
    {
        throw new Exception("Invalid file name");
    }
    $explods = explode('.', $temp['name']);
    $ext = $explods[count($explods)-1];
    $full_file_path = $path.$name.'.'.$ext;
    move_uploaded_file($temp['tmp_name'], $full_file_path);

    return $full_file_path;
}