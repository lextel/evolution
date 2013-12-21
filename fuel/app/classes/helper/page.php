<?php
/**
 * 分页辅助
 *
 * @author  : weelion <weelion@qq.com>
 * @version : 2.0
 */
namespace Helper;

class Page {

    const PAGESIZE = 5;
    
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
                'uri_segment'    => $uri_segment
            ];

    }
}
