<?php

namespace Helper;

class Image {

    /**
     * 显示图片
     *
     * @param $path string 图片路径
     * @param $size string 图片尺寸（空为原图）
     *
     * @return string
     */
    public static function showImage($path, $size = '') {
        $server = \Config::get('image_server');

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
    
    
    public static function showImage($src, $size = '') {
        //补全url
        $host = '';
        $path = '';
        if (empty($size)) return $host.$src;
        $mode = '/1/w/<Width>/h/<Height>';
        $w = '';
        $h = '';
        return $host.$path.$mode;
    }
}
