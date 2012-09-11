<?php

/**
 * @package    HelloWorld.Componente
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2012 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license    GNU General Public License version 3. See license.txt
 *
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
