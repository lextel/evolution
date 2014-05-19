<?php
/*
* APP文件路径处理
*
*/

namespace Classes;

use Fuel\core\File;
use Fuel\core\Config;

class Appfile {
    private $ROOT;
    //初始读取配置
    public function __construct() {
        Config::load('common');
        $this->ROOT = Config::get('apkFile');
    }
    //获得文件里的列表文件
    //@return array
    public function getDirFiles() {        
        $apkroot = $this->ROOT;
        $contents = File::read_dir($apkroot, 0, ['\.apk$' => 'file']);
        return $contents;
    }
    //获得APK的大小
    //@return int
    public function getSize($file){
        $path = $this->ROOT . '/' . $file;
        $size = File::get_size($path);
        return $this->getMbSize($size);
    }
    
    //小于1MB的显示成KB
    // @param int 文件大小
    // @return string
    private function getMbSize($size) {
        $kbsize = $size / 1000;
        $mbsize = $kbsize / 1000; 
        return $mbsize >= 1 ? round($mbsize, 2).'MB' : intval($kbsize).'KB';
    }
        
    //获得文件的列表的尺寸
    //@return array
    public function getFiles($files){
        $res = [];
        foreach($files as $file){
            $size = $this->getSize($file);
            $res[$file] = $size;
        }       
        return $res;
    }
    //diff 数据库里的APK列表
    //@return array
    public function getApks($link = ''){
        $files = $this->getDirFiles();
        //把本APP的路径显示出来
        if (empty($link)){
            $applinks = \DB::select("link")
                ->where('link', '!=', '')
                ->from('apps')->execute();
        }else{
            $applinks = \DB::select("link")
                ->where('link', '!=', '')
                ->where('link', '!=', $link)
                ->from('apps')->execute();
        }
        $usedFiles = [];
        foreach($applinks as $link){
            $usedFiles[] = $link['link'];
        }
        $files = array_diff($files, $usedFiles);
        return $files;
    }
}
