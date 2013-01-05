<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Import Joomla formrule library
jimport('joomla.form.formrule');

/**
 * Form Rule class for the Joomla Framework.
 * 
 * @package  Alligo.Joomla.Component.HelloWorld
 * @since    1.6
 */
class JFormRuleGreeting extends JFormRule {

		/**
		 * The regular expression.
		 *
		 * @access	protected
		 * @var		string
		 * @since	1.6
		 */
		protected $regex = '^[^0-9]+$';

}
