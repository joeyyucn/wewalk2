<?php
/**
 * Created by PhpStorm.
 * User: jyu2
 * Date: 2017/3/17
 * Time: 17:37
 */

namespace app\admin\model;


class SiteConfig implements \ArrayAccess
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
            $this->configs[$config->name] = $config->value;
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
        foreach ($this->configs as $key=> $value)
        {
            $list[count($list)] = ["name"=>$key, "value"=>$value];
        }
        $config->saveAll($list);
    }

    public function saveConfig($key)
    {
        $config = new Config();
        $config->name = $key;
        $config->value = $this->configs["key"];
        $config->isUpdate(true)->save();
    }

    public function offsetExists($name)
    {

        return isset($this->configs[$name]);
    }

    public function offsetUnset($name)
    {
        unset($this->configs[$name]);
    }

    public function offsetGet($name)
    {
        return $this->configs[$name];
    }

    public function offsetSet($name, $value)
    {
        $this->configs[$name] = $value;
    }

    public function toArray()
    {
        return  $this->configs;
    }
}