<?php

/**
 * 支付接口
 *
 * @copyright: lltao.com
 * @author   : weelion <weelion@qq.com>
 * @version  : 1.0
 */
namespace Classes;

class Payment {

    private static $config = [
                        'notifyUrl' => 'http://et.lltao.com/payment/notify',
                        'returnUrl' => 'http://et.lltao.com/payment/return',
                        'type' => [
                            'alipay' => ['id' => '2088411000022006','key' => 'oxkzlf3f8mq63nodvoovh7w6w038xsfq'],
                        ],
                ];

    public static function Instance($type) {

        $types = array_keys(self::$config['type']);


        if(!in_array($type, $types)) {
            throw new Exception ($type . '支付类型不存在');
        }

        $class = '\Classes\\' . ucfirst($type);
        return new $class(self::$config['notifyUrl'], self::$config['returnUrl'], self::$config['type'][$type]);
    }
}
?>
