<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/26
 * Time: 13:43
 */

namespace Common\Model;

use Think\Model;

class BaseModel extends Model
{
    /**
     * 获取模型实例，默认启用实例缓存，可不使用缓存
     * @statical array $_instance  实例缓存数组，单次访问缓存有效
     * @param bool $useCache        是否使用缓存数据
     * @return static               模型实例对象
     */
    public static function instance($useCache = true) {
        static $_instance = array();

        $class = get_called_class();

        if ($useCache && isset($_instance[$class])) {
            return $_instance[$class];
        }
        else {
            if ($class == __CLASS__) {
                $instance = new Model();
            }
            else {
                $instance = new static();
            }

            if ($useCache) {
                $_instance[$class] = $instance;
            }

            return $instance;
        }
    }
}