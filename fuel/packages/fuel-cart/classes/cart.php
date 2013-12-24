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


namespace Cart;

/**
 * Exception for invalid cart instance retrieval.
 */
class InvalidCartException extends \FuelException {}

/**
 * Exception for invalid cart item insert.
 */
class InvalidCartItemException extends \FuelException {}


abstract class Cart {
	/**
	 * @var  array  $default  default config
	 */
	protected static $default = array();

	/**
	 * @var  array  $instances  cart instances
	 */
	protected static $instances = array();

	/**
	 * @var  object  $instance  instance for singleton usage
	 */
	protected static $instance = null;

	/**
	 * Cart instance factory. Returns a new cart driver.
	 *
	 * @param       string    $cart      the cart identifier.
	 * @param       array     $config    aditional config array
	 * @return      object    new cart driver instance
	 * @deprecated  until 1.2
	 */
	public static function factory($cart = 'default', $config = array())
	{
		logger(\Fuel::L_WARNING, 'This method is deprecated.  Please use a forge() instead.', __METHOD__);
		return static::forge($cart, $config);
	}

	/**
	 * Cart instance factory. Returns a new cart driver.
	 *
	 * @param   string  $cart       the cart identifier.
	 * @param   array   $config     aditional config array
	 * @return  object  new cart driver instance
	 */
	public static function forge($cart = 'default', $config = array())
	{
		$key = $cart;
		empty($config) or $key.= md5(var_export($config, true));
		
		if(array_key_exists($key, static::$instances))
		{
			return static::$instances[$key];
		}
		
		$cart_config = \Config::get('cart.carts.'.$cart);
		
		if( ! is_array($cart_config))
		{
			throw new \InvalidCartException('Could not instantiate card: '.$cart);
		}
		
		$config = $config + $cart_config;
		$config = $config + static::$default;
		
		$storage_prefix = array_key_exists('storage_prefix', $config) ? $config['storage_prefix'] : \Config::get('cart.storage_prefix', 'fuel_');
		$storage_suffix = array_key_exists('storage_suffix', $config) ? $config['storage_suffix'] : \Config::get('cart.storage_suffix', '_cart');
		
		$config['storage_key'] = $storage_prefix.$cart.$storage_suffix;
		
		$driver = '\\Cart_'.ucfirst($config['driver']);
		if( ! class_exists($driver, true))
		{
			throw new \InvalidCartException('Unknown cart driver: '.$config['driver'].' ('.$driver.')');
		}
				
		$instance = new $driver($config);
		static::$instances[$key] =& $instance;

		return static::$instances[$key];
	}
	
	/**
	 * Resturns a cart driver instance.
	 *
	 * @param	string	$cart		the cart identifier.
	 * @param	array	$config		aditional config array
	 * @return	object	new cart driver instance
	 */
	public static function instance($cart = null, $config = array())
	{
		$cart or $cart = \Config::get('cart.default_cart', 'default');
		
		$key = $cart;
		empty($config) or $key.= md5(var_export($config, true));
		
		if(array_key_exists($key, static::$instances))
		{
			return static::$instances[$key];
		}
		return static::forge($cart, $config);
	}
	
	/**
	 * Method passthrough for static usage.
	 */
	public static function __callStatic($method, $args)
	{
		static::$instance or static::$instance = static::instance();
		
		if(method_exists(static::$instance, $method))
		{
			return call_user_func_array(array(static::$instance, $method), $args);
		}
		
		throw new \BadMethodCallException('Invalid method: '.get_called_class().'::'.$method);
	}

	/**
	 * Class init.
	 */
	public static function _init()
	{
		\Config::load('cart', true);
		
		static::$default = \Config::get('cart.default');
	}
	
}