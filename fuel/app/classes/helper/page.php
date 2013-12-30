<?php
/**
 * 分页辅助
 *
 * @author  : weelion <weelion@qq.com>
 * @version : 2.0
 */
namespace Helper;

class Page {

    const PAGESIZE = 4;

    /**
     * 设置分页配置
     *
     * @param $url         string  当前网址
     * @param $total       integer 总记录
     * @param $uri_segment integer 分页参数
     *
     * @return array 配置数组
     */
    public function setConfig($url, $total, $uri_segment = 3) {

        return [
                'pagination_url' => $url,
                'total_items'    => $total,
                'per_page'       => self::PAGESIZE,
                'uri_segment'    => $uri_segment,
                'wrapper'=>'<div class="pagination fr">{pagination}</div>',
                'previous-marker'=> "<上一页",
                'next-marker'    => "下一页>",
            ];

    }

    public function setCofigPage($url, $totle, $per_page=4, $uri_segment = 3){
        $res = $this -> setConfig($url, $totle, $uri_segment);
        $newconfig = [
                     'previous'=>'<span>{link}</span>',
                     'per_page' =>$per_page,
                     ];
       return array_merge($res, $newconfig);
    }

    /**
     * ajax翻页
     *
     * @param $fun   string  javascript函数
     * @param $total integer 总页数
     *
     * @return array 配置数组
     */
    public function setAjaxConfig($fun, $total) {

        return [
             'wrapper'=>'<div class="pagination fr">{pagination}</div>',
             'total_items' => $total,
             'per_page'       => self::PAGESIZE,
             'regular-link' => "\t\t<a href='javascript:void(0);' onclick='{$fun}({page})'>{page}</a>\n",
             'active-link' => "\t\t<a href='javascript:void(0);' onclick='{$fun}({page})'>{page}</a>\n",
             'next-link' => "\t\t<a href='javascript:void(0);' onclick='{$fun}({page})' rel='next'>{page}</a>\n",
             'previous-link' => "\t\t<a href='javascript:void(0);' onclick='{$fun}({page})' rel='prev'>{page}</a>\n",
             'previous-marker'=> "<上一页",
             'next-marker'    => "下一页>",
             'uri_segment' => 'page',
            ];

    }
}
