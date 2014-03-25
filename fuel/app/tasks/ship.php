<?php

/**
 * 运算结果
 */
namespace Fuel\Tasks;

class Ship {
    public static function run()
    {
        $ships = \Model_Shipping::find('all', ['where' => [['status', 'in', [100, 99, 0, 1, 2, 5]]]]);
        $cookie = dirname(__FILE__).DS.'cookie.txt';

        foreach($ships as $ship) {
            $url= 'http://www.kuaidi100.com/applyurl?key=20c160d67a34f548&com='.$ship->exname.'&nu='.$ship->excode;
            $resUrl = file_get_contents($url);

            if(function_exists('curl_init') != 1) return 'curl is not install';
            $useragent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36';

            @unlink($cookie);

            // HtmlApi
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $resUrl);
            curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
            curl_setopt($curl, CURLOPT_TIMEOUT,5);
            curl_exec($curl);
            curl_close($curl);
            // Json
            $jsonUrl = 'http://www.kuaidi100.com/query?id=1&type='.$ship->exname.'&postid='.$ship->excode.'&valicode=&temp='.rand(0,100);
            // http://www.kuaidi100.com/query?id=1&type=shunfeng&postid=903773876792&valicode=&temp=0.8495365139096975
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $jsonUrl);
            curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie); 
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
            curl_setopt($curl, CURLOPT_TIMEOUT,5);
            $content = curl_exec($curl);
            curl_close($curl);

            $data = json_decode(trim($content), true);

            if(isset($data['message']) && $data['message'] == 'ok') {
                $shipData = \Model_Shipping::find($ship->id);
                $shipData->status = $data['state'];
                $data['data'] = array_reverse($data['data']);
                $shipData->exdesc = json_encode($data['data']);
                $shipData->save();
            }

            sleep(5);
        }

        return 'success';
    }
}
