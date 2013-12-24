<?php
/**
 * A very flexible, full and easy cart solution for FuelPHP
 *
 * @package		Cart
 * @version		1.0
 * @author		Frank de Jonge (FrenkyNet)
 * @license		MIT License
 * @copyright	2010 - 2012 Frank de Jonge
 * @link		http://frankdejonge.nl
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(
	'storage_prefix'    => 'fuel_',
	'storage_suffix'    => '_cart',
	'default_cart'      => 'default',

	'default' => array(
		'tax'           => 0.19,
		'name'          => 'Cart',
		'dec_point'     => '.',
		'thousands_sep' => '',
		'driver'        => 'cookie',
		'cookie_expire' => 0,
		'auto_save'     => true,
	),

	'carts' => array(
		'default'	=> array(),
		
		// Add your carts below
		/**
		 * 'your_cart' => array(
		 * 		'name' => 'My Cart',
		 * 		'tax'  => 0.08
		 * ),
		*/
	),
);
