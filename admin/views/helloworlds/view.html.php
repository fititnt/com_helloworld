<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Importa Facade do JView focado em listagens
require_once __DIR__ . '/../_viewlist.php';

/**
 * HelloWorlds View
 * 
 * @package  Alligo.Joomla.Component.HelloWorld
 * @since    1.6
 */
class HelloWorldViewHelloWorlds extends HelloWorldViewListFacade {

		/**
		 * Contexto desta visão
		 * 
		 * @var  string 
		 */
		protected $context = 'HelloWorlds';

		/**
		 * Constructor.
		 *
		 * @param   array  $config  An optional associative array of configuration settings.
		 * 
		 * @since   11.1
		 */
		public function __construct($config = array())
		{
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

}
