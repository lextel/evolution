<?php
/**
 * 公共配置文件
 *
 * 使用Config::load('common');
 */
return [

    /**
     * @var 元宝:银币  1：100
     */
    'point'    => 100,

    /**
    *
    */
    'apkFile'  => DOCROOT.'download'.DS.'app',

    /**
     * @var 积分单位
     */

    'unit'     => '<img class="jin" src="/assets/img/jinbi.png">',
    'unit2'     => '元宝',
    'unit3'    => '<img class="yin" src="/assets/img/yinbi.png">',
    'unit4'     => '银币',

    /**
     * 邀请佣金
     */
    'invitPoints' => 0.6,  // 元宝数量
    'invitPercent' => 7,   // 消费回扣百分比  7 = 7%

    /**
     * 礼品码送元宝数量
     */
    'inviteCodeAddPoints' => 1,  // 赠送元宝数量

    /**
     * @var 揭晓时间 （单位:分钟）
     *
     * @tips 凌晨4点整到凌晨4点10分的揭晓双倍时间  给时间清空crontab
     */
    'open'    => 5,

    'default_headico' => 'upload/avatar/0/0/defaultavatar.jpg',

    'email_key' => 'zhujianglong~!@l0l0t0_com',
    'email_deadtime' => 3600 * 24 * 3,
    /**
     * @var 快递100密钥
     */
    'shipping_key' => '',

    'helppages' => [
              'guide'=>['title'=>'新手指南', 'page'=>'help/guide'],
              'about'=>['title'=>'关于乐淘', 'page'=>'help/about'],
              'new'=>['title'=>'了解乐淘', 'page'=>'help/new'],
              'examine'=>['title'=>'商品验货与签收', 'page'=>'help/examine'],
              'shipping'=>['title'=>'配送费用', 'page'=>'help/expressCost'],
              'expressinfo'=>['title'=>'商品配送', 'page'=>'help/expressInfo'],
              'longTime'=>['title'=>'长时间未收到商品', 'page'=>'help/longTime'],
              'pay'=>['title'=>'安全支付', 'page'=>'help/pay'],
              'privacy'=>['title'=>'隐私声明', 'page'=>'help/privacy'],
              'promise'=>['title'=>'正品承诺', 'page'=>'help/promise'],
              'question'=>['title'=>'常见问题', 'page'=>'help/question'],
              'safeguard'=>['title'=>'乐淘保障体系', 'page'=>'help/safeguard'],
              'serve'=>['title'=>'服务协议', 'page'=>'help/serve'],
              'suggest'=>['title'=>'投诉与建议', 'page'=>'help/suggest'],
              //'cooperation'=>['title'=>'合作专区', 'page'=>'help/cooperation'],
              'contact'=>['title'=>'联系我们', 'page'=>'help/contact'],
    ],

    // 七牛配置
    'qiniu' => [
        'ak'      => 'b7TsugV0nZ2bGV75GFdyAwwqGvop4tki75kWct90',   // AK 密钥
        'sk'      => 'VzOGW0G1FFqaCxy-2QKkU9oI3MO2XuUBO8Qp0OfT',   // SK 密钥
        'mime'    => 'image/jpeg;image/png;image/gif;image/jpg', // 上传mime头信息限制
        'host'    => 'http://lltao-%s.qiniudn.com/',
        'formurl' => 'http://up.qiniu.com/',
    ],

    //
    '99billtest' => [
        'merchantAcctId' => '1001213884201',
        'sendUrl' => 'https://sandbox.99bill.com/gateway/recvMerchantInfoAction.htm', //测试
        'returnUrl' => 'http://et.lltao.com/99bill/receive',
        'success' => 'http://et.lltao.com/99bill/success',
        'fail' => 'http://www.lltao.com/99bill/fail',
        'prikey' => 'pcarduser.pem',
        'pubkey' => '99bill[1].cert.rsa.20140803.cer',
        'testflag' => false,
    ],
    //快钱平台
    '99bill' => [
        'merchantAcctId' => '1002359733101',
        'sendUrl' => 'https://www.99bill.com/gateway/recvMerchantInfoAction.htm',
        'returnUrl' => 'http://www.lltao.com/99bill/receive',
        'success' => 'http://www.lltao.com/99bill/success',
        'fail' => 'http://www.lltao.com/99bill/fail',
        'prikey' => '99bill-rsa.pem',
        'pubkey' => '99bill.cert.rsa.20340630.cer', // quality date to 2014-06 ~ 2016 -06
         'testflag' => false,
    ],

    //百度钱包
    'bfb' => [
        'payreturn' => 'http://www.lltao.com/bfb/payreturn',
        'rechargereturn' => 'http://www.lltao.com/bfb/return',
        'paypage' => 'http://www.lltao.com/bfb/paypage',
        'rechargepage' => 'http://www.lltao.com/bfb/page',
    ],
    //
    'tenpay' => [
        'partner' => '1219629701',
        'key' => '4881e529321e9c27a7ab6023b6bb701e',
        'returnurl' => 'http://www.lltao.com/tenpay/return',
        'notifyurl' => 'http://www.lltao.com/tenpay/notify',
    ],
    //
    'yeebao' => [
        'requrl' => 'https://www.yeepay.com/app-merchant-proxy/node',
        'bgurl' => 'yeebao/callback',
        'p1_MerId'           => "10012408438",                                                                                                      #测试使用
        'merchantKey'    => "5h8h79262c5PJ579391nW745Y17RB4D05MAN81yPeT945M7lV659hT7I4ot6",       #测试使用
    ]
];
