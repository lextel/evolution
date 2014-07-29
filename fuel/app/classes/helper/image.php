<?php

namespace Helper;
use Fuel\Core\Config;

class Image {

    /**
     * 显示图片
     *
     * @param $path string 图片路径
     * @param $size string 图片尺寸（空为原图）
     * @param $bucket string 七牛空间
     *
     * @return string
     */
    public static function showImage($path, $size = '', $bucket = '') {
        // if (!empty($bucket)){
        //     return self::showQiniuImage($path, $bucket, $size);
        // }

        // 区分七牛临时解决方案
        $match = preg_match('/upload\/(item|desc|ad|post|avatar|icon)/', $path, $matchs);

        if($match) {
            return self::showDefaultImage($path, $size);
        } else {
            return self::showQiniuImage($path, $bucket, $size);
        }
    }

    //默认
    public static function showDefaultImage($path, $size = '') {
        $server = Config::get('image_server', 'http://www.lltao.com');
        return  $server . $path;
        $paths = explode('/', $path);
        array_shift($paths);
        if(!empty($size)) {
            $sizes = [$size];
            array_splice($paths, 1, 0, $sizes);
        } else {
            array_splice($paths, 0, 0, ['upload']);
        }

        $path = implode('/', $paths);

        return $server . $path;
    }

    /**
     * 七牛
     *
     * @param $path string 图片路径
     * @param $bucket string 七牛空间
     * @param $size string 图片尺寸（空为原图）
     *
     * @return string
     */
    public static function showQiniuImage($path, $bucket, $size = '') {

        Config::load('common');
        $server = Config::get('qiniu.host');
        $server = sprintf($server, $bucket);
        if (empty($size)) return $server.$path;
        $sizes = explode('x', $size);
        if (count($sizes) != 2){
            return $server.$path;
        }
        $w = $sizes[0];
        $h = $sizes[1];

        if($w == 0 || $h == 0) {
            $handle = 'imageMogr2/thumbnail/'.$w.'x/';
        } else {
            $handle = 'imageView2/1/w/'.$w.'/h/'.$h;
        }

        return $server.$path.'?'.$handle;
    }
}
