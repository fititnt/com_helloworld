<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Importa Facade do JView focado em itens
require_once __DIR__ . '/../_viewitem.php';

/**
 * HelloWorld View
 * 
 * @package  Alligo.Joomla.Component.HelloWorld
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
