<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * HelloWorld Form Field class for the HelloWorld component
 * 
 * @package  Joomla.Platform
 * @since    1.6
 */
class JFormFieldHelloWorld extends JFormFieldList {

		/**
		 * The field type.
		 *
		 * @var		string
		 */
		protected $type = 'HelloWorld';

		/**
		 * Method to get a list of options for a list input.
		 *
		 * @return	array		An array of JHtml options.
		 */
		protected function getOptions()
		{
				$db = JFactory::getDBO();
				$query = $db->getQuery(true);
				$query->select('#__helloworld.id as id,greeting,#__categories.title as category,catid');
				$query->from('#__helloworld');
				$query->leftJoin('#__categories on catid=#__categories.id');
				$db->setQuery((string) $query);
				$messages = $db->loadObjectList();
				$options = array();
				if ($messages)
				{
						foreach ($messages as $message)
						{
								$options[] = JHtml::_('select.option', $message->id, $message->greeting . ($message->catid ? ' (' . $message->category . ')' : ''));
						}
				}
				$options = array_merge(parent::getOptions(), $options);
				return $options;
		}

}
