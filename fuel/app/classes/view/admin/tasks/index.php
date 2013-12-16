<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The welcome 404 view model.
 *
 * @package  app
 * @extends  ViewModel
 */
class View_Admin_Tasks_Index extends ViewModel
{
    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */
    public function view()
    {
        $this->getUserNameById = function($userId) {
            $user =  Model_User::find($userId);

            return $user->username;
        };

        $this->getTaskType = function($typeId) {
            $config = Config::load('common');
            $types =  Config::get('taskType');
            foreach($types as $type) {
                if($type['typeId'] == $typeId) {
                    return $type['name'];
                }
            }
        };

        $this->isRead = function($flag) {
            return $flag == 1 ? '已读' : '未读';
        };
    }
}
