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
    'point'    => 10,

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
];
