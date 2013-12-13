<?php
/**
 * 分类辅助
 *
 * @author  : weelion <weelion@qq.com>
 * @version : 2.0
 */

namespace Classes;

class Cate {

    public $cates = [
                    [
                      'id'     => 1, 
                      'name'   => '手机', 
                      'childs' => [
                          ['id' => 101, 'name' => '苹果'],
                          ['id' => 102, 'name' => '三星'],
                          ['id' => 103, 'name' => '小米'],
                        ],
                    ],
                    [
                      'id'     => 2,
                      'name'   => '数码相机',
                      'childs' => [
                          ['id' => 201, 'name' => '尼康'],
                          ['id' => 202, 'name' => '佳能'],
                        ]
                    ],
                    [
                      'id'     => 3,
                      'name'   => '电脑',
                      'childs' => [
                          ['id' => 301, 'name' => '苹果'],
                          ['id' => 302, 'name' => '华硕'],
                          ['id' => 303, 'name' => '联想'],
                          ['id' => 304, 'name' => '三星'],
                        ]
                    ],
                    [
                      'id'     => 4,
                      'name'   => '平板电视',
                      'childs' => [
                          ['id' => 401, 'name' => '康佳'],
                          ['id' => 402, 'name' => '松下'],
                        ]
                    ],
                    [
                      'id'     => 5,
                      'name'   => '钟表首饰',
                      'childs' => [
                          ['id' => 501, 'name' => '劳力士'],
                          ['id' => 502, 'name' => '周大福'],
                        ]
                    ],
                    [
                      'id'     => 6,
                      'name'   => '其他商品',
                      'childs' => [
                          ['id' => 601, 'name' => '奔驰'],
                          ['id' => 602, 'name' => '宝马'],
                        ]
                    ],
    ];

  /**
   * 获取所有分类
   *
   * @return array 分类数组 如[1' => '手机', '2' => '其他']
   */
  public function cates() {

     $cates = [];
     foreach($this->cates as $cate) {
        $cates = $cates + [$cate['id'] => $cate['name']];
     }

     return $cates;
  }
}
