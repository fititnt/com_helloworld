<?php

/**
 * @package    HelloWorld.Componente
 * @author     Emerson Rocha Luiz <emerson@webdesign.eng.br>
 * @copyright  Copyright (C) 2012 Webdesign Assessoria em Tecnologia da Informacao. All rights reserved.
 * @license    GNU General Public License version 3. See license.txt
 *
 */
defined('_JEXEC') or die;

// Import Joomla modelform library
jimport('joomla.application.component.modeladmin');

/**
 * Esta classe funciona como um facade ao JModelAdmin do JPlatform. Ela é util em situações em que metodos devem ser adicionados a todas as classes
 * que a herdam, potencialmente util tanto para futuras atualizações como economia massiva de código repetido
 * 
 * @package  HelloWorld.Componente
 * @since    2.5
 */
class HelloWorldModelAdminFacade extends JModelAdmin {

	/**
	 * Contexto para o modelador
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $context = null;

	/**
	 * Constructor.
	 *
	 * @since   2.5
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	/**
	 * Method override to check if you can edit an existing record.
	 *
	 * @param   array   $data  An array of input data.
	 * @param   string  $key   The name of the key for the primary key.
	 *
	 * @return	boolean
	 * 
	 * @since	1.6
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		// Check specific edit permission then general edit permission.
		return JFactory::getUser()->authorise('core.edit', 'com_helloworld.message.' . ((int) isset($data[$key]) ? $data[$key] : 0)) or parent::allowEdit($data, $key);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 * 
	 * @return	mixed	A JForm object on success, false on failure
	 * 
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_helloworld.' . $this->context, $this->context, array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 *
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_helloworld.edit.' . $this->context . '.data', array());
		if (empty($data))
		{
			$data = $this->getItem();
		}
		return $data;
	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 * 
	 * @return  JTable  A database object
	 *
	 * @since   1.6
	 */
	public function getTable($type = '', $prefix = 'HelloWorldTable', $config = array())
	{
		if ($type === '')
		{
			$type = ucfirst($this->context);
		}
		return JTable::getInstance($type, $prefix, $config);
	}

}
