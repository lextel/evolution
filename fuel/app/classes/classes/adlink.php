<?php

namespace Classes;


class AdLink
{
    /*
    * 验证是否是最新商品的路径
    */
    public static function getItemId($url)
    {

        preg_match("/m\/(\d+)/i", $url, $itemId);

        if (empty($itemId)){
            return $url;
        }
        $phase = \DB::select("item_id")
        ->where('id', '=', \Str::lower($itemId[1]))
        ->limit(1)
        ->from('phases')->execute();
        $res = $phase->as_array();
        if (empty($res)){
            return $url;
        }
        $phase = \DB::select("id")
        ->where('item_id', '=', \Str::lower($res[0]['item_id']))
        ->order_by('id','desc')
        ->limit(1)
        ->from('phases')->execute();
        $res = $phase->as_array();
        $itemId = $res[0]['id'];
        return 'm/'.$itemId;
    }
}
