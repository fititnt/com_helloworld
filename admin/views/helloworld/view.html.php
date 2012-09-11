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

// Importa Facade do JView focado em itens
require_once __DIR__ . '/../_viewitem.php';

/**
 * HelloWorld View
 * 
 * @package  Joomla.Tutorials
 * @since    1.6
 */
class HelloWorldViewHelloWorld extends HelloWorldViewItemFacade {

	/**
	 * Contexto desta visão
	 * 
	 * @var  string 
	 */
	protected $context = 'HelloWorld';
}
