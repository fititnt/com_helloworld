<?php

/**
 * @package     Joomla.Tutorials
 * @subpackage  Components
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     License GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

// Import Joomla formrule library
jimport('joomla.form.formrule');

/**
 * Form Rule class for the Joomla Framework.
 * 
 * @package  Joomla.Tutorials
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
