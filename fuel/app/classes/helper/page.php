<?php
/**
 * 分页辅助
 *
 * @author  : weelion <weelion@qq.com>
 * @version : 2.0
 */
namespace Helper;

class Page {

    const PAGESIZE = 16;

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
                'regular-link' => "\t\t<a href='{uri}#list'>{page}</a>\n",
                'active-link' => "\t\t<a href='{uri}#list'>{page}</a>\n",
                'next-link' => "\t\t<a href='{uri}#list' rel='next'>{page}</a>\n",
                'previous-link' => "\t\t<a href='{uri}#list' rel='prev'>{page}</a>\n",
                'previous-inactive-link' => '<上一页',
                'next-inactive-link' => '下一页>',
                'previous-marker'=> "<上一页",
                'next-marker'    => "下一页>",
            ];

    }

    public function setCofigPage($url, $totle, $per_page=4, $uri_segment = 3){
        $res = $this -> setConfig($url, $totle, $uri_segment);
        $newconfig = [
                     'previous'=>'<span class="previous-inactive">{link}</span>',
                     'per_page' =>$per_page,
                     'previous-inactive' => "<span class=\"previous-inactive\">\n\t{link}\n</span>\n",
                     'next' => '<span class="previous-inactive">{link}</span>',
                     ];
       return array_merge($res, $newconfig);
    }

    public function setCommentPage($url, $fun,$totle, $per_page=4, $uri_segment = 3){
        $res = $this -> setConfig($url, $totle, $uri_segment);
        $newconfig = [
                     'previous'=>'<span class="previous-inactive">{link}</span>',
                     'per_page' =>$per_page,
                     'previous-inactive' => "<span class=\"previous-inactive\">\n\t{link}\n</span>\n",
                     'next' => '<span class="previous-inactive">{link}</span>',
                     'regular-link' => "\t\t<a href='javascript:;' onclick='{$fun}(\"{uri}\")'>{page}</a>\n",
                     'active-link' => "\t\t<a href='javascript:;' onclick='{$fun}(\"{uri}\")'>{page}</a>\n",
                     'next-link' => "\t\t<a href='javascript:;' rel='next' onclick='{$fun}(\"{uri}\")'>{page}</a>\n",
                     'previous-link' => "\t\t<a href='javascript:;' rel='prev' onclick='{$fun}(\"{uri}\")'>{page}</a>\n",
                     ];
       return array_merge($res, $newconfig);
    }

    /**
     * ajax翻页配置
     *
     * @param $fun   string  javascript函数名称
     * @param $total integer 总页数
     *
     * @return array 配置数组
     */
    public function setAjaxConfig($fun, $total, $pagenum=null) {
        if (!$pagenum){
            $prepage = "\"-1\"";
            $nextpage = "\"+1\"";
        }else{
            $prepage = intval($pagenum) -1;
            $nextpage = intval($pagenum) + 1;
        }
        return [
             'wrapper'=>'<div class="pagination fr">{pagination}</div>',
             'total_items' => $total,
             'per_page'       => self::PAGESIZE,
             'regular-link' => "\t\t<a href='javascript:void(0);' onclick='{$fun}({page})'>{page}</a>\n",
             'active-link' => "\t\t<a href='javascript:void(0);' onclick='{$fun}({page})'>{page}</a>\n",
             'next-link' => "\t\t<a href='javascript:void(0);' onclick='{$fun}({$nextpage})' rel='next'>{page}</a>\n",
             'previous-link' => "\t\t<a href='javascript:void(0);' onclick='{$fun}({$prepage})' rel='prev'>{page}</a>\n",
             'previous-inactive-link' => '<上一页',
             'next-inactive-link' => '下一页>',
             'previous-marker'=> "<上一页",
             'next-marker'    => "下一页>",
             'uri_segment' => 'page',
            ];

    }
}
