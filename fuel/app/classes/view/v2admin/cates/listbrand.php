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
class View_V2admin_Cates_Listbrand extends ViewModel
{
    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */
    public function view()
    {
        $this->getCateName = function($parentId) {
            $cate =  Model_Cate::find($parentId);

            return $cate->name;
        };
    }
}
