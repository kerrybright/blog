<?php
namespace Common\Common;
use Think\Exception;

class BaseClass
{
    /**
     * 判断是否存在类定义
     * @param $class
     * @return bool
     */
    public static function exists($class) {
        if (empty($class)) {
            return false;
        }

        $class = self::getClassWithNamespace($class);
        return class_exists($class);
    }

    /**
     * 获取带命名空间的完整类名
     * @param string $class
     * @return string
     */
    protected static function getClassWithNamespace($class) {
        if (self::hasClassNamespace($class)) {
            return $class;
        }
        else {
            return static::getNamespace() . '\\' . $class;
        }
    }

    /**
     * 判断类名是否已包含命名空间
     * @param string $class
     * @return bool
     */
    protected static function hasClassNamespace($class) {
        return strpos($class, '\\') !== false;
    }

    /**
     * 获取命名空间
     * @return string
     * @throws Exception     *
     */
    protected static function getNamespace() {
        throw new Exception('函数需要被子类重写');
    }
}