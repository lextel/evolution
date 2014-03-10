<?php
/**
 * 公共配置文件
 *
 * 使用Config::load('common');
 */
return [

    /**
     * @var 人民币兑换积分数目 默认1：10
     */
    'point'    => 1,

    /**
     * @var 积分单位
     */
    'unit'     => '乐淘币',

    /**
     * @var 揭晓时间 （单位:分钟）
     *
     * @tips 凌晨4点整到凌晨4点10分的揭晓双倍时间  给时间清空crontab
     */
    'open'    => 5,

    'default_headico' => 'upload/avatar/header.png',

    'email_key' => 'zhujianglong~!@l0l0t0_com',
    'email_deadtime' => 3600 * 24 * 3,
    /**
     * @var 快递100密钥
     */
    'shipping_key' => '',

    'helppages' => [
              'about'=>['title'=>'关于乐拍', 'page'=>'help/about'],
              'new'=>['title'=>'了解乐拍', 'page'=>'help/new'],
              'examine'=>['title'=>'商品验货与签收', 'page'=>'help/examine'],
              'shipping'=>['title'=>'配送费用', 'page'=>'help/expressCost'],
              'expressinfo'=>['title'=>'商品配送', 'page'=>'help/expressInfo'],
              'longTime'=>['title'=>'长时间未收到商品', 'page'=>'help/longTime'],
              'pay'=>['title'=>'安全支付', 'page'=>'help/pay'],
              'privacy'=>['title'=>'隐私声明', 'page'=>'help/privacy'],
              'promise'=>['title'=>'正品承诺', 'page'=>'help/promise'],
              'question'=>['title'=>'常见问题', 'page'=>'help/question'],
              'safeguard'=>['title'=>'乐拍保障体系', 'page'=>'help/safeguard'],
              'serve'=>['title'=>'服务协议', 'page'=>'help/serve'],
              'suggest'=>['title'=>'投诉与建议', 'page'=>'help/suggest'],
    ]
];
