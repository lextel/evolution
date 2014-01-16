<?php

namespace Helper;

class Breadcrumb {

    /**
     * 标题面包屑
     *
     * @param $breads array 面包屑数组
     *                      $breads[0]['name'] = 'xxx';
     *                      $breads[0]['href'] = '#';
     *
     * @return string 返回 AAA > BBB
     */
    public function title($breads) {

        $names = []; 
        foreach ($breads as $bread) {
            $names[] = $bread['name'];
        }

        return implode($names, ' > ');
    }

    /**
     * 页面面包屑
     *
     * @param $breads array 面包屑数组
     *                      $breads[0]['name'] = 'xxx';
     *                      $breads[0]['href'] = '#';
     *
     * @return string 返回 <li><a href="#">AAA</li><li class="active">BBB</li>
     */
    public function breadcrumb($breads) {

        $list = '';
        $count = count($breads);
        foreach ($breads as $key => $bread) {
            $class = '';
            if($key == $count-1) {
                $class = 'active';
            }

            $href = isset($bread['href']) ? $bread['href'] : 'javascript:void(0);';

            $list .= "<li class='{$class}'><a href='{$href}'>{$bread['name']}</a></li>";
        }

        return $list;
    }

}
