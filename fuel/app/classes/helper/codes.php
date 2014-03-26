<?php
namespace Helper;

class Codes {

    /**
     * 反序列化以及量大处理
     *
     * @param $codes 序列化的codes
     *
     * @return array
     */
    public static function getArray($codes) {

        $count = strlen($codes);

        // 如果大于1W只显示前1W个
        if($count > 178874 && $count <= 938900) {
            $data = unserialize($codes);
            array_splice($data, 10000);
            $data[10000] = '更多加载中...'; // 考虑分页
            return $data;
        } else if($count <= 178874) {
            return unserialize($codes);
        } else {
            // 不予显示
            return ['幸运码超过5万，服务器玩命处理中...'];
        }

    }

}
?>
