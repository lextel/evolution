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
 * The welcome hello view model.
 *
 * @package  app
 * @extends  ViewModel
 */
class View_Admin_Adminsms_View extends ViewModel
{
	/**
	 * 后台通知用户名获得
	 */
	public function view()
	{
		$this->getUsername = function($user_id) 
		{ 
		    $user = Model_User::find($user_id);
		    echo $user->username; 
		};
		$this->getDatetime = function($time)
		{
		    echo date("Y-m-d H:i:s",$time);
		};
	}
}
