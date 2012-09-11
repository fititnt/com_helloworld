<?php

/**
 * @package     Joomla.Platform
 * @subpackage  Application
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access to this file
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
