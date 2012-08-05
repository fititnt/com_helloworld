<?php

/**
 * @package     Joomla.Platform
 * @subpackage  Application
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

// Import Joomla table library
jimport('joomla.database.table');

/**
 * Hello Table class
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
class HelloWorldTableHelloWorld extends JTable {

	/**
	 * Constructor
	 *
	 * @param   object  &$db  Database connector object
	 *
	 * @since  1.5
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__helloworld', 'id', $db);
	}

	/**
	 * Overloaded bind function
	 *
	 * @param   array   $array   named array
	 * @param   string  $ignore  Ignore params
	 *
	 * @return  null|string  null is operation was satisfactory, otherwise returns an error
	 *
	 * @see JTable:bind
	 * @since 1.5
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
		{
			// Convert the params field to a string.
			$parameter = new JRegistry;
			$parameter->loadArray($array['params']);
			$array['params'] = (string) $parameter;
		}
		return parent::bind($array, $ignore);
	}

	/**
	 * Overloaded load function
	 *
	 * @param   int      $pk     primary key
	 * @param   boolean  $reset  reset data
	 *
	 * @return  boolean
	 *
	 * @see JTable:load
	 */
	public function load($pk = null, $reset = true)
	{
		if (parent::load($pk, $reset))
		{
			// Convert the params field to a registry.
			$params = new JRegistry;
			$params->loadJSON($this->params);
			$this->params = $params;
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Method to compute the default name of the asset.
	 * The default name is in the form `table_name.id`
	 * where id is the value of the primary key of the table.
	 *
	 * @return	string
	 *
	 * @since	1.6
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_helloworld.message.' . (int) $this->$k;
	}

	/**
	 * Method to return the title to use for the asset table.
	 *
	 * @return	string
	 *
	 * @since	1.6
	 */
	protected function _getAssetTitle()
	{
		return $this->greeting;
	}

	/**
	 * Get the parent asset id for the record
	 *
	 * @return	int
	 *
	 * @since	1.6
	 */
	protected function _getAssetParentId()
	{
		$asset = JTable::getInstance('Asset');
		$asset->loadByName('com_helloworld');
		return $asset->id;
	}

}
