<?php
/**
 * 上传辅助
 *
 * @author  : weelion<weelion@qq.com>
 * @version : 2.0
 */
namespace Helper;

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
    public function __construct($type) {

        $this->_config = Config::get('upload.'.$type);

        if(empty($this->_config)) {
            Log::error('Upload:' . 'config is not exists');
        }
    }

    /**
     * 获取配置
     *
     * @return array
     */
    public function getConfig() {

        return $this->_config;
    }

    /**
     * 上传处理
     *
     * @return boolean
     */
    public function upload() {

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
        	Log::error('Upload:' . $file['errors']);
        }
    }

    /**
     * 获取上传的文件
     *
     * @return array
     */
    public function getFiles($size = '') {

        $files = [];
        foreach(SysUpload::get_files() as $file) {

            $files[] = [
                'name'  => $file['saved_as'],
                'path'  => $file['saved_to'] . $file['saved_as'],
                'error' => $file['error'],
                'type'  => $file['type'],
                ];
        }

        return $files;
    }

}
