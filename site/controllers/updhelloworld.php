<?php

/**
 * @package     Joomla.Tutorials
 * @subpackage  Components
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     License GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access.
defined('_JEXEC') or die;

// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');

/**
 * HelloWorld Controller
 * 
 * @package  Joomla.Tutorials
 * @since    1.6
 */
class HelloWorldControllerUpdHelloWorld extends JControllerForm {

	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   11.1
	 */
	public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, array('ignore_request' => false));
	}

	/**
	 * Submit the request
	 * 
	 * @return  boolean 
	 */
	public function submit()
	{
		// Check for request forgeries.
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app = JFactory::getApplication();
		$model = $this->getModel('updhelloworld');

		// Get the data from the form POST
		$data = JRequest::getVar('jform', array(), 'post', 'array');

		// Now update the loaded data to the database via a function in the model
		$upditem = $model->updItem($data);

		// Check if ok and display appropriate message.  This can also have a redirect if desired.
		if ($upditem)
		{
			echo "<h2>Updated Greeting has been saved</h2>";
		}
		else
		{
			echo "<h2>Updated Greeting failed to be saved</h2>";
		}

		return true;
	}

}
