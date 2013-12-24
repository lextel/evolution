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


Autoloader::add_core_namespace('Cart');

Autoloader::add_classes(array(
	'Cart\\Cart'						=> __DIR__.'/classes/cart.php',
	'Cart\\InvalidCartException'		=> __DIR__.'/classes/cart.php',
	'Cart\\InvalidCartItemException'	=> __DIR__.'/classes/cart.php',
	'Cart\\Cart_Item'					=> __DIR__.'/classes/cart/item.php',
	'Cart\\Cart_Driver'					=> __DIR__.'/classes/cart/driver.php',
	'Cart\\Cart_Auth'					=> __DIR__.'/classes/cart/auth.php',
	'Cart\\Cart_Cookie'					=> __DIR__.'/classes/cart/cookie.php',
	'Cart\\Cart_Session'				=> __DIR__.'/classes/cart/session.php',
));