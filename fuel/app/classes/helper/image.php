<?php

namespace Helper;
use Fuel\Core\Config;

class Image {

    /**
     * 显示图片
     *
     * @param $path string 图片路径
     * @param $size string 图片尺寸（空为原图）
     * @type  $size string 选择类型（空为默认，可选qiniu）
     * @return string
     */
    public static function showImage($path, $size = '', $type = '') { 
        if ($type == 'qiniu'){
            return self::showQiniuImage($path, $size);
        }
        return self::showDefaultImage($path, $size);
    }
    //默认
    public static function showDefaultImage($path, $size = '') {
        $server = Config::get('image_server');

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
}
