<?php
/**
 * 上传辅助
 *
 * @author  : weelion<weelion@qq.com>
 * @version : 2.0
 */
namespace Classes;

use \Exception;
use Fuel\Core\Log;
use Fuel\Core\Config;
use Fuel\Core\Upload as SysUpload;

class Upload {

    /**
     * 上传配置
     *
     * @var array
     */
    private $_config;

    /**
     * 构造函数
     * 
     * 配置在app\config\config.php设置
     *
     * @param $type string 上传类型 
     *                     item   商品图片
     *                     post   晒单图片
     *                     avatar 会员头像
     *
     * @return void
     */
    public function __construct($type = '') {

        Config::load('upload');
        $this->_config = Config::get($type);

        // 改写文件夹
        SysUpload::register('before', function (&$file) {
            if ($file['error'] == SysUpload::UPLOAD_ERR_OK) {
                $filename = $file['filename'];
                $path = $file['path'] . $filename[0];
                $this->_checkDir($path);
                $path .= DS . $filename[1];
                $this->_checkDir($path);
                $file['path'] = $path . DS;
            }
        });
    }

    /**
     * 检查目录
     *
     * 如果没有创建则创建目录
     *
     * @return void
     */
    private function _checkDir($path) {
        if(!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    }

    /**
     * 配置
     *
     * @return array
     */
    public function setConfig($config) {

        return $this->_config = $config;
    }

    /**
     * 上传处理
     *
     * @return boolean
     */
    public function upload() {

        if(empty($this->_config)) {
            throw new Exception('upload config is not exists');
        }

        SysUpload::process($this->_config);

        if (SysUpload::is_valid()) {
            SysUpload::save();

            return true;
        } else {
          $this->errors();

          return false;
        }
    }

    /**
     * 错误处理
     *
     * @return void
     */
    protected function errors() {

        foreach(SysUpload::get_errors() as $file) {
            Log::error('Upload:' . $file['errors'][0]['message']);
        }
    }

    /**
     * 获取上传的文件
     *
     * @return array
     */
    public function getFiles($size = '') {

        $files = [];

        $image = new \Classes\Image();
        foreach(SysUpload::get_files() as $file) {

            $files[] = [
                'name'  => $file['saved_as'],
                'link'  => $image->path2url($file['saved_to'] . $file['saved_as']),
                'path'  => $file['saved_to'] . $file['saved_as'],
                'error' => $file['error'],
                'type'  => $file['type'],
                ];
        }

        return $files;
    }

}
