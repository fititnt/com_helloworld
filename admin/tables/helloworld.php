<?php

/**
 * @package     Joomla.Platform
 * @subpackage  Application
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('_JEXEC') or die;

// Importa Facade do JTable
require_once '_jtable.php';

/**
 * Hello Table class
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
class HelloWorldTableHelloWorld extends HelloWorldJTableFacade {
  
	/**
	 * Name of the database table to model.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $_tabela = '#__helloworld';

	/**
	 * Constructor.
	 *
	 * @since   2.5
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

}
