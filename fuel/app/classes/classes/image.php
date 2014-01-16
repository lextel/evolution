<?php
/**
 * 图片辅助
 *
 * @author  : weelion<weelion@qq.com>
 * @version : 2.0
 */
namespace Classes;

use Fuel\Core\Uri;
use Fuel\Core\Image as SysImage;

class Image {

    /**
     * 存储路径转url路径
     *
     * @param $path    string  存储路径
     * @param $getFull boolean 是否获取全url
     *
     * @return string url路径
     */
    public function path2url($path, $getFull = false) {

        $root = str_replace(DS, '/', DOCROOT);
        
        $link = str_replace($root, '', $path);

        return $getFull ? Uri::base() . $link : $link;
    }

    /**
     * url路径转存储路径
     *
     * @param $link string url路径
     *
     * @return string 存储路径
     */
    public function url2path($link) {

        $link = str_replace(Uri::base(), '', $link);
        $link = str_replace('/', DS, $link);

        $path = DOCROOT . $link;

        return $path;
    }

    /**
     * 生成缩略图
     *
     * 图片路径必须是原图路径也就是带origin目录的路径
     *
     * @param $link  string 图片url
     * @param $size  string 图片重置大小 格式60x60
     *
     * @return string 重置后路径
     */
    public function resize($link, $size) {

        $path   = $this->url2path($link);
        
        $resizePath = $this->resizePath($path, $size);

        $sizes  = explode('x', $size);
        $width  = $sizes[0];
        $height = $sizes[1];

        if(file_exists($path) && !file_exists($resizePath)) {
            SysImage::load($path)->crop_resize($width, $height)->save($resizePath);
        }

        return $this->path2url($resizePath);
    }

    /**
     * 获取resize后的路径
     *
     * @param $path string 原图路径
     * @param $size string 尺寸
     *
     * @return string 
     */
    public function resizePath($path, $size) {

        $path = str_replace(DS, '/', $path);

        preg_match('/upload\/(\w+)\//', $path, $match);

        $path = str_replace($match[1], $match[1].'/'.$size, $path);

        $dir = dirname($path);
        if(!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        return $path;
    }
}
