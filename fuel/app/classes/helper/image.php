<?php
/**
 * 图片辅助
 *
 * @author  : weelion<weelion@qq.com>
 * @version : 2.0
 */
namespace Helper;

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
        
        $link = str_replace(DOCROOT, '', $path);
        $link = str_replace(DS, '/', $link);

        return $getFull ? Uri::base() . $link : $link;
    }

    /**
     * url路径转存储路径
     *
     * @param $link   string url路径  如 upload/item/origin/xxx.jpg
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
        $sizes  = explode('x', $size);
        $width  = $sizes[0];
        $height = $sizes[1];
        $newPath   = str_replace('origin', $size, $path);

        SysImage::load($path)->crop_resize($width, $height)->save($newPath);

        return $this->path2url($newPath);
    }
}
