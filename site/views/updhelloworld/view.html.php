<?php

/**
 * @package     Alligo.Joomla.Component.HelloWorld
 * @subpackage  Components
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     License GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

// Import Joomla view library
jimport('joomla.application.component.view');

// Import Joomla html for use with stylesheets
jimport('joomla.html.html');

/**
 * HTML View class for the UpdHelloWorld Component
 * 
 * @package  Alligo.Joomla.Component.HelloWorld
 * @since    1.6
 */
class HelloWorldViewUpdHelloWorld extends JViewLegacy {

	/**
	 * Overwriting JView display method
	 *
	 * @param   string  $tpl  Template to load
	 * 
	 * @return  boolean  
	 */
	public function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$params = $app->getParams();
		$dispatcher = JDispatcher::getInstance();

		// Get some data from the models
		$state = $this->get('State');
		$item = $this->get('Item');
		$this->form = $this->get('Form');
		$this->state = $state;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// Get the stylesheet and/or other document values
		$this->addDocStyle();

		// Display the view
		parent::display($tpl);
	}

	/**
	 * Add the stylesheet to the document.
	 * 
	 * @return  void
	 */
	protected function addDocStyle()
	{
		$doc = JFactory::getDocument();
		$doc->addStyleSheet('media/com_helloworld/css/site.stylesheet.css');
	}

}
