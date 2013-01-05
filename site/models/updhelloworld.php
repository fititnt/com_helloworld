<?php

/**
 * @package     Alligo.Joomla.Component.HelloWorld
 * @subpackage  Components
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     License GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

// Include dependancy of the main model form
jimport('joomla.application.component.modelform');

// Import Joomla modelitem library
jimport('joomla.application.component.modelitem');

// Include dependancy of the dispatcher
jimport('joomla.event.dispatcher');

/**
 * UpdHelloWorld Model
 * 
 * @package  Alligo.Joomla.Component.HelloWorld
 * @since    1.6
 */
class HelloWorldModelUpdHelloWorld extends JModelForm {

	/**
	 * @var object item
	 */
	protected $item;

	/**
	 * Get the data for a new qualification
	 * 
	 * @param   array    $data      Data to get
	 * @param   boolean  $loadData  If data must be loaded
	 * 
	 * @return  object
	 */
	public function getForm($data = array(), $loadData = true)
	{

		$app = JFactory::getApplication('site');

		// Get the form.
		$form = $this->loadForm('com_helloworld.updhelloworld', 'updhelloworld', array('control' => 'jform', 'load_data' => true));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}

	/**
	 * Get the message
	 * 
	 * @return  object   The message to be displayed to the user
	 */
	public function &getItem()
	{

		if (!isset($this->_item))
		{
			$cache = JFactory::getCache('com_helloworld', '');
			$id = $this->getState('helloworld.id');
			$this->_item = $cache->get($id);
			if ($this->_item === false)
			{

				// Menu parameters
				$menuitemid = JRequest::getInt('Itemid');  // this returns the menu id number so you can reference parameters
				$menu = JSite::getMenu();
				if ($menuitemid)
				{
					$menuparams = $menu->getParams($menuitemid);

					// This shows how to get an individual parameter for use
					$headingtxtcolor = $menuparams->get('headingtxtcolor');

					// This shows how to get an individual parameter for use
					$headingbgcolor = $menuparams->get('headingbgcolor');
				}

				// This sets the parameter values to the state for later use
				$this->setState('menuparams', $menuparams);
			}
		}
		return $this->_item;
	}

	/**
	 * Get ID
	 *
	 * @param   array  $data  Data to load
	 * 
	 * @return  boolean
	 */
	public function updItem($data)
	{
		// Set the variables from the passed data
		$id = $data['id'];
		$greeting = $data['greeting'];

		// Set the data into a query to update the record
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->clear();
		$query->update(' #__helloworld ');
		$query->set(' greeting = ' . $db->Quote($greeting));
		$query->where(' id = ' . (int) $id);

		$db->setQuery((string) $query);

		if (!$db->query())
		{
			JError::raiseError(500, $db->getErrorMsg());
			return false;
		}
		else
		{
			return true;
		}
	}

}
