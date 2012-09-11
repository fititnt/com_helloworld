<?php

/**
 * @package     Joomla.Platform
 * @subpackage  Application
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access to this file
defined('_JEXEC') or die;

// Importa Facade do JModelList
require_once '_modellist.php';

/**
 * HelloWorldList Model
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
class HelloWorldModelHelloWorlds extends HelloWorldModelListFacade {

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		// Create a new query object
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('id,greeting');

		// From the hello table
		$query->from('#__helloworld');
		return $query;
	}

}
