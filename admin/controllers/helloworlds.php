<?php

/**
 * @package     Joomla.Platform
 * @subpackage  Application
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * HelloWorlds Controller
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
class HelloWorldControllerHelloWorlds extends JControllerAdmin {

	/**
	 * Proxy for getModel
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   11.1
	 */
	public function getModel($name = 'HelloWorld', $prefix = 'HelloWorldModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

}
