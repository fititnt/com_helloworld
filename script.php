<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

/**
 * Script file of HelloWorld component
 * 
 * @package  Alligo.Joomla.Component.HelloWorld
 * @since    1.6
 */
class com_HelloWorldInstallerScript {

		/**
		 * Method to install the component
		 * 
		 * @param   object  $parent  The class calling this method
		 *
		 * @return  void
		 */
		public function install($parent)
		{
				// $parent is the class calling this method
				$parent->getParent()->setRedirectURL('index.php?option=com_helloworld');
		}

		/**
		 * Method to uninstall the component
		 * 
		 * @param   object  $parent  The parent
		 *
		 * @return  void
		 */
		public function uninstall($parent)
		{
				// $parent is the class calling this method
				echo '<p>' . JText::_('COM_HELLOWORLD_UNINSTALL_TEXT') . '</p>';
		}

		/**
		 * Method to update the component
		 * 
		 * @param   object  $parent  The class calling this method
		 *
		 * @return  void
		 */
		public function update($parent)
		{
				echo '<p>' . JText::_('COM_HELLOWORLD_UPDATE_TEXT') . '</p>';
		}

		/**
		 * Method to run before an install/update/uninstall method
		 * 
		 * @param   object  $type    Type of change (install, update or discover_install)
		 * @param   object  $parent  The class calling this method
		 *
		 * @return  void
		 */
		public function preflight($type, $parent)
		{
				echo '<p>' . JText::_('COM_HELLOWORLD_PREFLIGHT_' . $type . '_TEXT') . '</p>';
		}

		/**
		 * Method to run after an install/update/uninstall method
		 * 
		 * @param   object  $type    Type of change (install, update or discover_install)
		 * @param   object  $parent  The class calling this method
		 *
		 * @return  void
		 */
		public function postflight($type, $parent)
		{
				echo '<p>' . JText::_('COM_HELLOWORLD_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
		}

}
