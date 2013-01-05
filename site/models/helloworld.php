<?php

/**
 * @package     Alligo.Joomla.Component.HelloWorld
 * @subpackage  Components
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     License GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

// Import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * HelloWorld Model
 * 
 * @package  Alligo.Joomla.Component.HelloWorld
 * @since    1.6
 */
class HelloWorldModelHelloWorld extends JModelItem {

	/**
	 * @var object item
	 */
	protected $item;

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * 
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication();

		// Get the message id
		$id = JRequest::getInt('id');
		$this->setState('message.id', $id);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
		parent::populateState();
	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 * 
	 * @return  JTable  A database object
	 * 
	 * @since   1.6
	 */
	public function getTable($type = 'HelloWorld', $prefix = 'HelloWorldTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Get the message
	 * 
	 * @return  object  The message to be displayed to the user
	 */
	public function getItem()
	{
		if (!isset($this->item))
		{
			$id = $this->getState('message.id');
			$this->_db->setQuery(
						$this->_db->getQuery(true)
						->from('#__helloworld as h')
						->leftJoin('#__categories as c ON h.catid=c.id')
						->select('h.greeting, h.params, c.title as category')
						->where('h.id=' . (int) $id)
					);
			if (!$this->item = $this->_db->loadObject())
			{
				$this->setError($this->_db->getError());
			}
			else
			{
				// Load the JSON string
				$params = new JRegistry;
				$params->loadJSON($this->item->params);
				$this->item->params = $params;

				// Merge global params with item params
				$params = clone $this->getState('params');
				$params->merge($this->item->params);
				$this->item->params = $params;
			}
		}
		return $this->item;
	}

}
