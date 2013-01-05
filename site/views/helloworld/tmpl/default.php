<?php

/**
 * @package     Alligo.Joomla.Component.HelloWorld
 * @subpackage  Components
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     License GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;
?>
<h1><?php echo $this->item->greeting . (($this->item->category and $this->item->params->get('show_category')) ? (' (' . $this->item->category . ')') : ''); ?></h1>
