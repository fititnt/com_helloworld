<?php

/**
 * @package    Alligo.Joomla.Component.HelloWorld
 *
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2005 - 2013 Alligo LTDA.
 * @license    GNU General Public License version 2; see LICENSE
 */
defined('_JEXEC') or die;

// Import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Esta classe funciona como um facade ao JControllerForm do JPlatform. Ela é util em situações em que metodos devem ser adicionados a todas 
 * as classes que a herdam, potencialmente util tanto para futuras atualizações como economia massiva de código repetido
 * 
 * @package  HelloWorld.Componente
 * @since    2.5
 */
class HelloWorldJControllerFormFacade extends JControllerForm {
  
}
