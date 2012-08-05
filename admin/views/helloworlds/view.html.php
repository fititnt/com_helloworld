<?php

/**
 * @package     Joomla.Tutorials
 * @subpackage  Components
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     License GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Import Joomla view library
jimport('joomla.application.component.view');

/**
 * HelloWorlds View
 * 
 * @package  Joomla.Tutorials
 * @since    1.6
 */
class HelloWorldViewHelloWorlds extends JViewLegacy {

	/**
	 * Overwriting JView display method
	 *
	 * @param   string  $tpl  Template to load
	 * 
	 * @return  boolean  
	 */
	public function display($tpl = null)
	{
		// Get data from the model
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		$this->items = $items;
		$this->pagination = $pagination;

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 * 
	 * @return  void
	 */
	protected function addToolBar()
	{
		$canDo = HelloWorldHelper::getActions();
		JToolBarHelper::title(JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLDS'), 'helloworld');
		if ($canDo->get('core.create'))
		{
			JToolBarHelper::addNew('helloworld.add', 'JTOOLBAR_NEW');
		}
		if ($canDo->get('core.edit'))
		{
			JToolBarHelper::editList('helloworld.edit', 'JTOOLBAR_EDIT');
		}
		if ($canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'helloworlds.delete', 'JTOOLBAR_DELETE');
		}
		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_helloworld');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION'));
	}

}
