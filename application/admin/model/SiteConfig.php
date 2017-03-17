<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/3/17
 * Time: 17:37
 */

namespace app\admin\model;


class SiteConfig
{
    private $configs = [];

    public static function load()
    {
        return new SiteConfig();
    }

    public function __construct()
    {
        $all_configs = Config::all();
        for($i = 0; $i < count($all_configs); $i++)
        {
            $config = $all_configs[$i];
            $configs[$config->name] = $config->value;
        }
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->configs[$name];
    }

    public function __set($name, $value)
    {
        $this->configs[$name] = $value;
    }

    public function save()
    {
        $config = new Config();
        $list = [];
        foreach ($config as $key=> $value)
        {
            $list[count($list)] = ["name"=>$key, "value"=>$value];
        }
        $config->saveAll($list);
    }
}