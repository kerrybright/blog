<?php
namespace Common\Enum;
use Common\Common\BaseClass;
use Common\Common\Utils;

class BaseEnum extends BaseClass
{
    const ENUM_TEXT_POSTFIX = '_TEXT';

    protected $enums = array();

    /**
     * 获取枚举值、显示文本的键值对数组
     * @param null|array|string $enumValueLimit
     * @return array
     */
    public function getSelectionList($enumValueLimit = null) {
        $enums = $this->enums;

        if ($enumValueLimit !== null) {
            $enumValueLimit = Utils::toArray($enumValueLimit);

            foreach ($enums as $key => $text) {
                if (!in_array($key, $enumValueLimit)) {
                    unset($enums[$key]);
                }
            }
        }

        return $enums;
    }

    /**
     * 获取枚举值文本数组
     * @return array
     */
    public function getTextList() {
        return array_values($this->enums);
    }

    /**
     * 获取枚举值的值数组
     * @return array
     */
    public function getValueList()
    {
        return array_keys($this->enums);
    }

    /**
     * 获取枚举值对应的显示文本
     * @param int|string $value 枚举值
     * @return mixed
     */
    public function getText($value) {
        $enums = $this->enums;
        $text = (isset($enums[$value]) ? $enums[$value] : $value);
        return $text;
    }

    /**
     * 获取枚举值文本对应的枚举值
     * @param $text
     * @return int|null|string
     */
    public function getValue($text) {
        $enums = $this->enums;
        foreach ($enums as $value => $enumText) {
            if ($text == $enumText) {
                return $value;
            }
        }
        return null;
    }

    /**
     * 检查值是否存在在枚举值中
     * @param int|string $value
     * @return bool
     */
    public function existsValue($value) {
        $enums = $this->enums;
        return isset($enums[$value]);
    }

    /**
     * 获取枚举类实例
     * @param null|string $class 枚举类名
     * @return static
     */
    public static function instance($class = null) {
        static $_instance = array();

        if (is_null($class)) {
            $class = get_called_class();
        }
        else {
            $class = self::getClassWithNamespace($class);
        }

        if (!isset($_instance[$class])) {
            $_instance[$class] = new $class();
        }
        return $_instance[$class];
    }

    /**
     * 获取当前命名空间
     * @return string
     */
    protected static function getNamespace() {
        return __NAMESPACE__;
    }

    /**
     * 构造函数
     */
    protected function __construct() {
        $this->init();
    }

    /**
     * 根据反射构造枚举值数据
     */
    protected function init() {
        $refClass = new \ReflectionClass($this);
        $constants = $refClass->getConstants();

        foreach ($constants as $constant => $value) {
            if (strpos($constant, self::ENUM_TEXT_POSTFIX) !== false) {
                continue;
            }

            $constantText = $constant . self::ENUM_TEXT_POSTFIX;
            $text = $refClass->getConstant($constantText);
            $this->enums[$value] = ($text !== false ? $text : $value);
        }
    }
}