<?php

return [

    /**
     * Default settings
     */
    'defaults' => [

        /**
         * Mail useragent string
         */
        'useragent' => 'FuelPHP, PHP 5.3 Framework',
        /**
         * Mail driver (mail, smtp, sendmail, noop)
         */
        'driver'        => 'smtp',

        /**
         * Whether to send as html, set to null for autodetection.
         */
        'is_html'       => null,

        /**
         * Email charset
         */
        'charset'       => 'utf-8',

        /**
         * Wether to encode subject and recipient names.
         * Requires the mbstring extension: http://www.php.net/manual/en/ref.mbstring.php
         */
        'encode_headers' => true,

        /**
         * Ecoding (8bit, base64 or quoted-printable)
         */
        'encoding'      => '8bit',

        /**
         * Email priority
         */
        'priority'      => \Email::P_NORMAL,

        /**
         * Default sender details
         */
        'from'      => [
            'email'     => 'leletao_com@163.com',
            //'email' => 'no_reply@lltao.com',
            'name'      => '乐乐淘官方',
        ],

        /**
         * Default return path
         */
        'return_path'   => false,

        /**
         * Whether to validate email addresses
         */
        'validate'  => true,

        /**
         * Auto attach inline files
         */
        'auto_attach' => true,

        /**
         * Auto generate alt body from html body
         */
        'generate_alt' => true,

        /**
         * Forces content type multipart/related to be set as multipart/mixed.
         */
        'force_mixed'   => false,

        /**
         * Wordwrap size, set to null, 0 or false to disable wordwrapping
         */
        'wordwrap'  => 76,

        /**
         * Path to sendmail
         */
        //'sendmail_path' => '/usr/sbin/sendmail',

        /**
         * SMTP settings
         */
        'smtp'  => [
            'host'      => 'smtp.163.com',
            'port'      => 25,
            'username'  => 'leletao_com@163.com',
            'password'  => 'zhujianglong',
            /*
            'host'      => 'smtp.exmail.qq.com',
            'port'      => 25,
            'username'  => 'no_reply@lltao.com',
            'password'  => 'taolele2014',*/
            'timeout'   => 5,
        ],

        /**
         * Newline
         */
        'newline'   => "\n",

        /**
         * Attachment paths
         */
        'attach_paths' => [
            // absolute path
            '',
            // relative to docroot.
            DOCROOT,
        ],
    ],

    /**
     * Default setup group
     */
    'default_setup' => 'default',

    /**
     * Setup groups
     */
    'setups' => [
        'default' => [],
    ],

    'mailHost' => [
            '163.com' => 'mail.163.com',
            'vip.163.com' => 'vip.163.com',
            '126.com' => 'mail.126.com',
            'qq.com' => 'mail.qq.com',
            'vip.qq.com' => 'mail.qq.com',
            'foxmail.com' => 'mail.qq.com',
            'gmail.com' => 'mail.google.com',
            'sohu.com' => 'mail.sohu.com',
            'tom.com' => 'mail.tom.com',
            'vip.sina.com' => 'vip.sina.com',
            'sina.com.cn' => 'mail.sina.com.cn',
            'sina.com' => 'mail.sina.com.cn',
            'yahoo.com.cn' => 'mail.cn.yahoo.com',
            'yahoo.cn' => 'mail.cn.yahoo.com',
            'yeah.net' => 'www.yeah.net',
            '21cn.com' => 'mail.21cn.com',
            'hotmail.com' => 'www.hotmail.com',
            'sogou.com' => 'mail.sogou.com',
            '188.com' => 'www.188.com',
            '139.com' => 'mail.10086.cn',
            '189.cn' => 'webmail15.189.cn/webmail',
            'wo.com.cn' => 'mail.wo.com.cn/smsmail',
    ],

];
