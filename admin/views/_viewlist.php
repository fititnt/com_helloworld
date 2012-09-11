<?php

/**
 * @package    PortfolioX.Componente
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2012 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license    GNU General Public License version 3. See license.txt
 *
 */
defined('_JEXEC') or die;

// Import Joomla view library
jimport('joomla.application.component.view');

/**
 * PXs View
 * 
 * @package  PortfolioX.Componente
 * @since    2.5
 */
class HelloWorldViewListFacade extends JViewLegacy {

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
			$this->context_plural = $this->context;
		}
		if (!$this->context_singular)
		{
			$this->context_singular = substr($this->context, 0, -1);
		}

		parent::__construct($config);
	}

	/**
	 * Setting the toolbar
	 * 
	 * @return  void
	 */
	protected function addToolBar()
	{
		$canDo = HelloWorldHelper::getActions();
		JToolBarHelper::title(JText::_('COM_PX_MANAGER_' . strtoupper($this->context)), 'generic.png');
		if ($canDo->get('core.create'))
		{
			JToolBarHelper::addNew($this->context_singular . '.add', 'JTOOLBAR_NEW');
		}
		if ($canDo->get('core.edit'))
		{
			JToolBarHelper::editList($this->context_singular . '.edit', 'JTOOLBAR_EDIT');
		}
		if ($canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', $this->context_plural . '.delete', 'JTOOLBAR_DELETE');
		}
		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_px');
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
		$document->setTitle(JText::_('COM_PX_ADMINISTRATION_' . strtoupper($this->context)));
	}

}
