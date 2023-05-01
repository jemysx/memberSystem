<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF V2.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace App\Helpers;

class Functions
{

    /**
     * stdClass转数组
     * @param $obj
     * @return array
     */
    public static function stdToArray($obj) :array{
        if($obj){
            $obj = json_decode(json_encode($obj),true);
        }else{
            $obj = [];
        }
        return $obj;
    }

}
