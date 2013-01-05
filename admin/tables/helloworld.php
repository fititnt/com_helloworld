<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Importa Facade do JTable
require_once '_jtable.php';

/**
 * Hello Table class
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
class HelloWorldTableHelloWorld extends HelloWorldJTableFacade {

		/**
		 * Name of the database table to model.
		 *
		 * @var    string
		 * @since  11.1
		 */
		protected $_tabela = '#__helloworld';

		/**
		 * Constructor.
		 *
		 * @since   2.5
		 */
		public function __construct($config = array())
		{
				parent::__construct($config);
		}

}
