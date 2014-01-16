<?php
/**
 * 分类辅助
 *
 * @author  : weelion <weelion@qq.com>
 * @version : 2.0
 */

namespace Classes;

use Fuel\core\Config;

class Cate {

  /**
   * 获取所有分类
   *
   * @return array 分类数组 如[1' => '手机', '2' => '其他']
   */
    public function cates() {

        $allCates = Config::load('cate');

        $cates = [];
        foreach($allCates as $cate) {
            $cates = $cates + [$cate['id'] => $cate['name']];
        }

        return $cates;
    }
}
