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
 * HelloWorld component helper.
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
abstract class HelloWorldHelper {

		/**
		 * Configure the Linkbar.
		 * 
		 * @param   string  $submenu  Submenu name
		 * 
		 * @return  void
		 */
		public static function addSubmenu($submenu)
		{
				JSubMenuHelper::addEntry(JText::_('COM_HELLOWORLD_SUBMENU_MESSAGES'), 'index.php?option=com_helloworld', $submenu == 'messages');
				JSubMenuHelper::addEntry(JText::_('COM_HELLOWORLD_SUBMENU_CATEGORIES'), 'index.php?option=com_categories&view=categories&extension=com_helloworld', $submenu == 'categories');

				// Set some global property
				$document = JFactory::getDocument();
				$document->addStyleDeclaration('.icon-48-helloworld {background-image: url(../media/com_helloworld/images/tux-48x48.png);}');
				if ($submenu == 'categories')
				{
						$document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION_CATEGORIES'));
				}
		}

		/**
		 * Get the actions
		 * 
		 * @param   int  $messageId  ID of message
		 *
		 * @return  boolean  
		 */
		public static function getActions($messageId = 0)
		{
				$user = JFactory::getUser();
				$result = new JObject;

				if (empty($messageId))
				{
						$assetName = 'com_helloworld';
				}
				else
				{
						$assetName = 'com_helloworld.message.' . (int) $messageId;
				}

				$actions = array(
						'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
				);

				foreach ($actions as $action)
				{
						$result->set($action, $user->authorise($action, $assetName));
				}

				return $result;
		}

}
