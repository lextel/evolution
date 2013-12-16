<?php
/**
 * 公共配置文件
 *
 * 使用Config::load('common');
 */
return [
    /**
     * @var 每页记录数
     */
    'pagesize' => 10,

    /**
     * @var 人民币兑换积分数目 默认1：10
     */
    'point'    => 10,

    /**
     * @var 任务类型
     */
    'taskType' => [
        'item' => ['typeId' => 1, 'name' => '商品'],
        'post' => ['typeId' => 2, 'name' => '晒单'],
    ]

];
