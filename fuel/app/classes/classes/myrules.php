<?php
/*
*新增的规则定义
*/
namespace Classes;
class MyRules
{
    // note this is a static method
    /*
    *验证是否重复
    */
    public static function _validation_unique($val, $options)
    {
        list($table, $field) = explode('.', $options);

        $result = \DB::select("LOWER (\"$field\")")
        ->where($field, '=', \Str::lower($val))
        ->from($table)->execute();

        return ! ($result->count() > 0);
    }
    /*
    * 验证手机号码
    */ 
    public static function _validation_is_mobile($val)
    {       
        if(preg_match("/^1[0-9]{10}$/",$val)){    
            //验证通过
            return true;           
        }
        return false;
    }
    // note this is a non-static method
    public function _validation_is_upper($val)
    {
        return $val === strtoupper($val);
    }

}

?>
