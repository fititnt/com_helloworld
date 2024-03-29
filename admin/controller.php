<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * General Controller of HelloWorld component
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
class HelloWorldController extends JControllerLegacy {

		/**
		 * Typical view method for MVC based architecture
		 *
		 * This function is provide as a default implementation, in most cases
		 * you will need to override it in your own controllers.
		 *
		 * @param   boolean  $cachable  If true, the view output will be cached
		 *
		 * @return  JController  A JController object to support chaining.
		 *
		 * @since   11.1
		 */
		public function display($cachable = false, $urlparams = false)
		{
				// Set default view if not set
				JRequest::setVar('view', JRequest::getCmd('view', 'HelloWorlds'));

				// Call parent behavior
				parent::display($cachable);

				// Set the submenu
				HelloWorldHelper::addSubmenu('messages');
		}

}
