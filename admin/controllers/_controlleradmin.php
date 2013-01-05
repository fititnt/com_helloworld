<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * Esta classe funciona como um facade ao JControllerAdmin do JPlatform. Ela é util em situações em que metodos devem ser adicionados a todas 
 * as classes que a herdam, potencialmente util tanto para futuras atualizações como economia massiva de código repetido
 * 
 * @package  HelloWorld.Componente
 * @since    2.5
 */
class HelloWorldJControllerAdminFacade extends JControllerAdmin {

		/**
		 * Contexto atual
		 *
		 * @var    string
		 * @since  2.5
		 */
		protected $context = null;

		/**
		 * Proxy for getModel
		 *
		 * @return  object  The model.
		 *
		 * @since   11.1
		 */
		public function getModel()
		{
				// Parte do presuposto que irá retornar um contexto plural, porém é necessário saber singular
				$name = ucfirst(substr($this->context, 0, -1));

				$model = parent::getModel($name, 'HelloWorldModel', array('ignore_request' => true));

				return $model;
		}

}
