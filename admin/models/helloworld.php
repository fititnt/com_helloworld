<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Importa Facade do JModelAdmin
require_once '_modeladmin.php';

/**
 * HelloWorld Model
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
class HelloWorldModelHelloWorld extends HelloWorldModelAdminFacade {

		/**
		 * Constructor.
		 *
		 * @since   2.5
		 */
		public function __construct($config = array())
		{
				$this->context = 'HelloWorld';
				parent::__construct($config);
		}

		/**
		 * Method to get the data that should be injected in the form.
		 *
		 * @return	mixed	The data for the form.
		 *
		 * @since	1.6
		 */
		protected function loadFormData()
		{
				// Check the session for previously entered form data.
				$data = JFactory::getApplication()->getUserState('com_helloworld.edit.helloworld.data', array());
				if (empty($data))
				{
						$data = $this->getItem();
				}
				return $data;
		}

}
