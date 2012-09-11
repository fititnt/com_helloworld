<?php

/**
 * @package    HelloWorld.Componente
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2012 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license    GNU General Public License version 3. See license.txt
 *
 */
defined('_JEXEC') or die;

// Import Joomla view library
jimport('joomla.application.component.view');

/**
 * HelloWorldViewItemFacade
 * 
 * @package  HelloWorld.Componente
 * @since    2.5
 */
class HelloWorldViewItemFacade extends JViewLegacy {

	/**
	 * Contexto atual desta visão
	 * 
	 * @var  string 
	 */
	protected $context = null;

	/**
	 * Contexto desta visão do tipo singular
	 * 
	 * @var  string 
	 */
	protected $context_singular = null;

	/**
	 * Contexto desta visão do tipo plural
	 * 
	 * @var  string 
	 */
	protected $context_plural = null;

	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 * 
	 * @since   11.1
	 */
	public function __construct($config = array())
	{
		// Parte do principio que se trata de apenas remover a ultima letra para tornar singular. Existem excessões. Se for o caso, sobrescreva-o
		if (!$this->context_plural)
		{
			$this->context_plural = $this->context . 's';
		}
		if (!$this->context_singular)
		{
			$this->context_singular = $this->context;
		}

		parent::__construct($config);
	}

	/**
	 * Overwriting JView display method
	 *
	 * @param   string  $tpl  Template to load
	 * 
	 * @return  boolean  
	 */
	public function display($tpl = null)
	{

		// Get the Data
		$form = $this->get('Form');
		$item = $this->get('Item');
		$script = $this->get('Script');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->form = $form;
		$this->item = $item;
		$this->script = $script;

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
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = $this->item->id == 0;
		$canDo = HelloWorldHelper::getActions($this->item->id);
		JToolBarHelper::title(
				$isNew ? JText::_('COM_PX_MANAGER_' . strtoupper($this->context) . '_NEW') : JText::_('COM_PX_MANAGER_'
								. strtoupper($this->context) . '_EDIT'), 'generic.png'
				);

		// Built the actions for new and existing records.
		if ($isNew)
		{
			// For new records, check the create permission.
			if ($canDo->get('core.create'))
			{
				JToolBarHelper::apply($this->context_singular . '.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save($this->context_singular . '.save', 'JTOOLBAR_SAVE');
				JToolBarHelper::custom($this->context_singular . '.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			}
			JToolBarHelper::cancel($this->context_singular . '.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			if ($canDo->get('core.edit'))
			{
				// We can save the new record
				JToolBarHelper::apply($this->context_singular . '.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save($this->context_singular . '.save', 'JTOOLBAR_SAVE');

				// We can save this record, but check the create permission to see if we can return to make a new one.
				if ($canDo->get('core.create'))
				{
					JToolBarHelper::custom($this->context_singular . '.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
				}
			}
			if ($canDo->get('core.create'))
			{
				JToolBarHelper::custom($this->context_singular . '.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			}
			JToolBarHelper::cancel($this->context_singular . '.cancel', 'JTOOLBAR_CLOSE');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = $this->item->id == 0;
		$document = JFactory::getDocument();
		$document->setTitle(
				$isNew ? JText::_('COM_PX_MANAGER_' . strtoupper($this->context) . '_NEW') :
						JText::_('COM_PX_MANAGER_' . strtoupper($this->context) . '_EDIT')
				);
	}

}
