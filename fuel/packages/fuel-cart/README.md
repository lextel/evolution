Cart package for Fuel
=====================

Introduction
------------

The Cart package handles one or multiple carts. Some specs:

+ Handles one or multiple Carts
+ Option support for Items
+ Options can add value to the product price.
+ Very easy to use. ;)

# Install

Io install this package simply type in:

	php oil package install cart
	
and you're off. Or download it manually and place in you packages directory.

# Configuration

Copy config/cart.php to app/config/cart.php and change whatever setting in need of changing.


# Usage

Single Cart Usage
-----------------

Add an item to the cart:

	$rowid = Cart::add(array(
		'name' => 'Blue Ball',
		'id' => 'toys_2937',
		'qty' => 1,
		'price' => 6.99,
	));
	
	$rowids = Cart::add(array(
		array(
			'name' => 'Blue Ball',
			'id' => 'toys_2937',
			'qty' => 1,
			'price' => 6.99,
		),
		array(
			'name' => 'Red Ball',
			'id' => 'toys_2938',
			'qty' => 1,
			'price' => 6.99,
		),
		array(
			'name' => 'Green Ball',
			'id' => 'toys_2939',
			'qty' => 3,
			'price' => 5.99,
		),
	));
	
Delete an item from a cart:

	Cart::remove($rowid);
	
	$items = Cart::items();
	
	foreach($items as $item)
	{
		if($item->get_id() == 'prod_1234')
		{
			$item->delete();
		}
	}
	
Get an item from a cart

	$item = Cart::item($rowid);
	
Update an item

	$item->update('name', 'New Name');
	
Update an item's options

	// Add color option 'blue' with an added value of 2.50
	$item->set_option('color', 'blue', 2.50);
	
	// Delete the option
	$item->delete_option('color');
	
	// See if the item has options
	if($item->has_options())
	{
		// do something here
	}
	
	// see if an item has a specific option
	if($item->has_option('color'))
	{
		// do something here
	}
	
Please note: when an item's option change, so will it's rowid.


Multi Cart Usage
----------------

Get an cart instance:

	$cart = Cart::instance();

Add an item to the cart, with options:

	$cart->add(array(
		'name' => 'Blue Ball',
		'id' => 'toys_2937',
		'qty' => 1,
		'price' => 6.99,
	), array(
		'wrapping' => 'Giftwrap',
		'extra' => array('Ball pump', 2.99), // add an option with an added price
	));
	
Schema Needed for Auth
----------------------

Raw sql:

	CREATE TABLE `carts` (
		`id` int(255) NOT NULL AUTO_INCREMENT,
		`user_id` int(255) NOT NULL,
		`identifier` varchar(100) NOT NULL,
		`contents` text NOT NULL,
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
