<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Importa Facade do JControllerAdmin
require_once '_controlleradmin.php';

/**
 * HelloWorlds Controller
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
class HelloWorldControllerHelloWorlds extends HelloWorldJControllerAdminFacade {

		/**
		 * Contexto atual
		 *
		 * @var    string
		 * @since  2.5
		 */
		protected $context = 'HelloWorlds';

}
